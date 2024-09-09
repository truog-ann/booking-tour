<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->name && $request->name != null) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if (isset($request->role)) {
            $query->where('role', intval($request->role));
        }
        if (isset($request->is_active)) {
            $query->where('is_active', intval($request->is_active));
        }
        $users = $query->orderByDesc('created_at')->paginate(10);
        $title = 'Users list';
        return view('admin.user.index', compact('users', 'title'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(string $id)
    {
        $user = User::with('vouchers')->findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'role' => 'nullable',
            'is_active' => 'nullable',
        ]);
        $request->is_active ? $request->is_active : $request->merge(['is_active' => 0]);
        $request->role ? $request->role : $request->merge(['role' => 0]);
        $user = User::find($request->id);
        $user->update([
            'role' => $request->role,
            'is_active' => intval($request->is_active),
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function addVoucher(Request $request, string $user_id)
    {
        $user = User::findOrFail($user_id);
        $voucher = Voucher::findOrFail($request->voucher_id);

        $userVoucher = new UserVoucher([
            'voucher_id' => $voucher->id,
            'user_id' => $user->id,
            'using_voucher' => false
        ]);

        $user->userVouchers()->save($userVoucher);

        return redirect()->route('users.show', $user->id)->with('success', 'Voucher added successfully.');
    }
}
