<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseJson;
use App\Models\User;
use App\Notifications\RepassUserClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    protected $response;
    public function __construct(ResponseJson $response)
    {
        $this->response = $response;
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống',

        ]);
        if ($validator->fails()) {
            return $this->response->responseFailed($validator->errors()->first());
        }
        $user = [
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => 1
        ];
        if (Auth::attempt($user)) {
            // $request->session()->regenerate();

            Auth::user()->token = Hash::make(Auth::user()->id);
            return $this->response->responseSuccess(Auth::user());
        } else {
            return $this->response->responseFailed('Tài khoản không tồn tại hoặc chưa được kích hoạt');

        }

    }
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ], [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
        ]);
        if ($validator->fails()) {
            return $this->response->responseFailed($validator->errors()->first());
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user) {
            return $this->response->responseSuccess($request->all(), 'Đăng ký thành công');
        } else {
            return $this->response->responseFailed('Đăng ký thất bại');
        }
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->id)],
            'file' => 'nullable',
            'date_of_birth' => 'nullable|date|after:' . now()->toDateString() . "'",
            'phone' => 'nullable|regex:/^(0[0-9]{9,10})$/',
            'address' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->response->responseFailed($validator->errors()->first());
        }



        if (Hash::check($request->id, $request->token)) {
            $user = User::find($request->id);
            if ($user) {
                if ($request->hasFile('file')) {
                    $image = $request->file;
                    $imageName = "storage/users/test-" . time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('storage/users'), $imageName);

                }
                $user->update([...$request->all(), 'avatar' => $imageName ?? $user->avatar]);

                $user->token = Hash::make($user->id);
                return $this->response->responseSuccess($user, 'Cập nhật thành công');


            }
            return $this->response->responseFailed('Người dùng không tồn tại');

        } else {
            return $this->response->responseFailed('Cập nhật thất bại');
        }


    }
    public function forgetPassMail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);
        if ($validator->fails()) {
            return $this->response->responseFailed($validator->errors()->first());
        }
        $user = User::where('is_active', 1)->where('email', $request->email)->first();
        if ($user) {
            $token = Crypt::encryptString($user->id);
            $user->notify(new RepassUserClient($token));
            return $this->response->responseSuccess();
        }
        return $this->response->responseFailed("Tài khoản không tồn tại hoặc chưa được kích hoạt");

    }
    public function changeForgetPass(Request $request)
    {
        try {
            $id = Crypt::decryptString($request->token);
            $user = User::where('id', $id)->where('is_active', 1)->first();
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:8|max:32',
                'password_confirm' => 'required|min:8|max:32|same:password'
            ]);
            if ($validator->fails()) {
                return $this->response->responseFailed($validator->errors()->first());
            }
            if (!$user) {
                return $this->response->responseFailed('Tài khoản không tồn tại hoặc chưa được kích hoạt');
            }
            // Cập nhật mật khẩu mới
            $user->password = Hash::make($request->password);
            $user->save();
            return $this->response->responseSuccess('Đổi mật khẩu thành công.');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Nếu không thể giải mã token, chuyển hướng về trang đăng nhập
            return $this->response->responseFailed('Token không hợp lệ.');
        }
    }

    public function changePass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->response->responseFailed($validator->errors()->first());
        }
        if (Hash::check($request->id, $request->token)) {
            $user = User::find($request->id);
            if ($user) {
                if (Hash::check($request->old_password, $user->password)) {
                    $user->update(['password' => Hash::make($request->new_password)]);
                    return $this->response->responseSuccess('Đổi mật khẩu thành công');
                }
                return $this->response->responseFailed('Mật khẩu cũ không đúng');
            }
            return $this->response->responseFailed('Không tìm thấy tài khoản');
        }
        return $this->response->responseFailed('Token không hợp lệ');
    }
    public function logout()
    {
        Auth::logout();
        return $this->response->responseSuccess([], 'Đăng xuất thành công');
    }
}
