<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\RepassUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    //
    public function form()
    {
        $title = "Login Admin";
        return view('auth.login', compact('title'));
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $request->merge(['is_active' => 1]);
        $credentials = $request->only('email', 'password', 'is_active');
        if (auth()->attempt($credentials)) {
            if (auth()->user()->role == 1) {
                return redirect()->route('admin.index')->with('success', 'Logged in success');

            } else {
                auth()->logout();
                return redirect()->route('auth.login')->with('error', 'You are not admin');
            }
        }
        return redirect()->back()->with('error', 'Wrong password or email or Account don\'t active');

    }
    public function resgister(Request $request)
    {
        $title = "Resgister";

        if ($request->method() == 'GET') {
            return view('auth.register', compact('title'));
        }
        $request->validate([
            'email' => 'email|required|unique:users,email',
            'name' => 'required',
            'password' => 'required|min:8|max:32',
            'password_confirm' => 'required|min:8|max:32|same:password'

        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 1,
            'is_active' => 0
        ];
        $user = User::create($data);
        if ($user) {
            return redirect(route('auth.login'))->with('success', 'Đăng ký thành công.<br>Đợi quản trị viên kích hoạt tài khoản của bạn');
        }
        return back()->with('error', 'Đăng ký thất bại');
    }
    public function repass(Request $request)
    {
        $title = "Forget pass";

        if ($request->method() == 'GET') {
            return view('auth.repass', compact('title'));
        }
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        $user = User::where('is_active', 1)->where('email', $request->email)->first();
        if ($user) {
            $token = Crypt::encryptString($user->id);
            $user->notify(new RepassUser($token));
            return back()->with('success', 'Đợi mail để hoàn thành yêu cầu');
        }
        return back()->with('error', 'Tài khoản không tồn tại hoặc chưa được kích hoạt');
    }
    public function change(Request $request)
    {

        try {
            $title = "Change pass";
            $id = Crypt::decryptString($request->token);
            $user = User::where('id', $id)->first();
            if ($user) {
                return view('auth.change-pass', compact('id', 'title'));
            }
            return redirect(route('auth.login'))->with('error', 'Tài khoản không hợp lệ');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Nếu không thể giải mã token, chuyển hướng về trang đăng nhập
            return redirect(route('auth.login'))->with('error', 'Token không hợp lệ.');
        }



    }
    public function changePass(Request $request)
    {
        try {
            $user = User::find($request->id);
            if (!$user) {
                return redirect(route('auth.login'));
            }
            $request->validate([
                'password' => 'required|min:8|max:32',
                'password_confirm' => 'required|min:8|max:32|same:password'
            ]);


            // Cập nhật mật khẩu mới
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect(route('auth.login'))->with('success', 'Đổi mật khẩu thành công');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Đổi mật khẩu thất bại');

        }

    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('auth.login')->with('success', 'Logout success');
    }

}
