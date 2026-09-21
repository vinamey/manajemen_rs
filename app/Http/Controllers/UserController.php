<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
   public function index()
{
    $users = User::with('roles')->get();
    $roles = Role::all();

    return view('users.index', compact('users', 'roles'));
}

    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $user->syncRoles([$request->role]);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }


public function resetPasswordForm($id)
{
    $user = User::findOrFail($id);

    return view('users.reset-password', compact('user'));
}

public function resetPassword(Request $request, $id)
{
    $request->validate([
        'password' => 'required|min:8|confirmed',
    ]);

    $user = User::findOrFail($id);

    $user->password = Hash::make($request->password);

    $user->save();

    return redirect()->route('users.index')
                     ->with('success', 'Password berhasil direset.');
}
}
