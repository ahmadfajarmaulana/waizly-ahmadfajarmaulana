<?php
namespace App\Repositories;

use App\Models\Role;


class RoleRepository
{
    public function index()
    {
        $roles = Role::get();
        return $roles;
    }

    public function create($request)
    {
        $role = Role::create([
            'role_name'      => $request->role_name,
        ]);

        return $role;
    }

    public function update($request, $id)
    {
        $role = Role::findOrFail($id);

        $role->update([
            'role_name'      => $request->role_name,
        ]);

        return $role;
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);

        $role->delete($id);

        return $role;
    }
}