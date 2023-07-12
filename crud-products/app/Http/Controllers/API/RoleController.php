<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleSaveRequest;
use App\Repositories\RoleRepository;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(
        RoleRepository $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    public function getAllRoles()
    {
        $roles = $this->roleRepository->index();

        return response()->json([
            'success'   => true,
            'message'   => 'list data Roles',
            'data'      => $roles
        ], 200);
    }

    public function createRole(RoleSaveRequest $request)
    {
        $role = $this->roleRepository->create($request);

        return response()->json([
            'success'   => true,
            'message'   => 'Role Successfully Created',
            'data'      => $role
        ], 201);
    }

    public function updateRole(RoleSaveRequest $request, $id)
    {
        $role = $this->roleRepository->update($request, $id);

        return response()->json([
            'success'   => true,
            'message'   => 'Role Successfully Updated',
            'data'      => $role
        ], 201);
    }

    public function deleteRole($id)
    {
        $this->roleRepository->delete($id);
        
        return response()->json([
            'success'   => true,
            'message' => 'Role Successfully deleted'
        ], 200);
    }
}
