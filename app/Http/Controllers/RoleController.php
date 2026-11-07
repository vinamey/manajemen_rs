<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
    // ==============================
    // MENAMPILKAN DATA ROLE
    // ==============================
    public function index()
    {
        $roles = Role::orderBy('id', 'ASC')->get();

        $permissions = Permission::orderBy('name')->get();

        return view('roles.index', compact('roles', 'permissions'));
    }

    // ==============================
    // FORM TAMBAH ROLE
    // ==============================
    public function create()
    {
        return view('roles.create');
    }

    // ==============================
    // SIMPAN ROLE BARU
    // ==============================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    // ==============================
    // FORM EDIT ROLE
    // ==============================
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('roles.edit', compact('role'));
    }

    // ==============================
    // UPDATE ROLE
    // ==============================
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil diupdate.');
    }

    // ==============================
    // HAPUS ROLE
    // ==============================
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if (strtolower($role->name) === 'super admin') {
            return redirect()->route('roles.index')
                ->with('error', 'Role Super Admin tidak boleh dihapus.');
        }

        $role->delete();

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil dihapus.');
    }

    // ==============================
    // FORM ASSIGN PERMISSION
    // ==============================
    public function givePermission($id)
    {
        $role = Role::findOrFail($id);

        $permissions = Permission::orderBy('name')->get();

        return view('roles.permission', compact('role', 'permissions'));
    }

    // ==============================
    // SIMPAN PERMISSION KE ROLE
    // ==============================
    public function givePermissionStore(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'permission' => 'nullable|array',
            'permission.*' => 'string|exists:permissions,name',
        ]);

        $permissions = $request->input('permission', []);

        $role->syncPermissions($permissions);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('roles.index')
            ->with('success', 'Permission berhasil diperbarui.');
    }
}
