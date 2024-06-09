<?php

namespace App\Http\Controllers;

use App\Exceptions\PermissionException;
use App\Http\Requests\RoleCreateRequest;
use Illuminate\Http\Request;
use App\Http\Requests\RolesRequest;
use App\Http\Requests\updateRolesRequest;
use App\Http\Services\RolesPermissionsService;
use Exception;

class RolesPermissionController extends Controller
{

    protected $rolesPermissionService;
    function __construct(RolesPermissionsService $rolesPermissionService){
        $this->rolesPermissionService = $rolesPermissionService;
       
            $this->middleware('can:create permission')->only('assignRolePermissions');
         
    }
    /**
     * Handle the incoming request.
     */
    public function getUserRolesPermissions()
    {
        return $this->rolesPermissionService->getUserRolesPermissions();
    }

    // public function updateUserRoles(updateRolesRequest $updateRolesRequest)
    // {
    //     return $this->rolesPermissionService->updateUserRoles($updateRolesRequest);
    // }

    public function revokeUserRoles(RolesRequest $request)
    {
        return $this->rolesPermissionService->revokeUserRoles($request);
    }

    public function assignUserRoles(RolesRequest $request)
    {
        return $this->rolesPermissionService->assignUserRoles($request);
    }
    public function assignRolePermissions($role , Request $request){
        return $this->rolesPermissionService->assignRolePermissions($role, $request);
    }

    public function store(RoleCreateRequest $request){
        return $this->rolesPermissionService->addRole($request);
    }

    public function getRoles(){
       return $this->rolesPermissionService->getRoles();
    }

    public function destroy($role){
        return $this->rolesPermissionService->destroyRole($role);
    }
}
