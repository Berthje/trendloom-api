<?php

namespace App\Http\Controllers;

use App\Modules\Roles\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends ApiServiceController
{
    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    public function getAllRoles()
    {
        return $this->getAll();
    }

    public function createRole(Request $request)
    {
        return $this->create($request);
    }

    public function getRoleById($roleId)
    {
        return $this->get($roleId);
    }

    public function updateRole(Request $request, $roleId)
    {
        return $this->update($request, $roleId);
    }

    public function deleteRole($roleId)
    {
        return $this->delete($roleId);
    }
}
