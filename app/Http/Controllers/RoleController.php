<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Menampilkan semua role
    public function index()
    {
        $roles = Role::orderBy('id', 'ASC')->get();

        return view('roles.index', compact('roles'));
    }

    // Form tambah role
    public function create()
    {
        return view('roles.create');
    }

    // Simpan role baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::create([
            'name' => $request->name
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    // Form edit role
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('roles.edit', compact('role'));
    }

    // Update role
    public function update(Request $request, $id)
{
    $role = Role::findOrFail($id);

    $request->validate([
        'name' => 'required|unique:roles,name,' . $role->id,
    ]);

    $role->update([
        'name' => $request->name,
    ]);

    return redirect()->route('roles.index')
        ->with('success', 'Role berhasil diupdate.');
}

    // Hapus role
    public function destroy($id)
{
    $role = Role::findOrFail($id);

    if($role->name == 'Super Admin')
    {
        return redirect()->route('roles.index')
            ->with('error','Role Super Admin tidak boleh dihapus.');
    }

    $role->delete();

    return redirect()->route('roles.index')
        ->with('success','Role berhasil dihapus.');
}

// Form Assign Permission
public function givePermission($id)
{
    $role = Role::findOrFail($id);

    $permissions = Permission::orderBy('name')->get();

    return view('roles.permission', compact('role', 'permissions'));
}

// Simpan Permission ke Role
public function givePermissionStore(Request $request, $id)
{
    $role = Role::findOrFail($id);

    $role->syncPermissions($request->permission ?? []);

    return redirect()->route('roles.index')
        ->with('success', 'Permission berhasil diberikan ke Role.');
}
}