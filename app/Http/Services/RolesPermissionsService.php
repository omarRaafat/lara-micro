<?php 

namespace App\Http\Services;
use App\Models\User;
use Spatie\Permission\Models\Role;


class RolesPermissionsService{


    protected $user;
    function __construct()
    {
            $this->user = User::find(1);
            $this->user->invalidateCache();
            $this->user->cacheRolesAndPermissions();
            
    }

    public function getUserRolesPermissions()
    {
        $this->user->email= setTextToLower($this->user->email);
        return $this->user;
    }

   

    public function revokeUserRoles($request)
    {
        // return $request->role;
        try{
            $this->user->removeRole($request->role);
            return $this->user;
        }
        catch(\Exception $e){
            return $e;
        }
    }

    public function assignUserRoles($request)
    {
      
        $this->user->roles()->sync($request->roles);
        return $this->user;
    }


    public function addRole($request){
        // return $request->role;
        $role = Role::create(['name'=>$request->role , 'guard_name' => 'api']);
        return $role;
    }

    public function getRoles(){

      
        $roles =  Role::select('id','name')->get();
        return $roles;
    }

    public function assignRolePermissions($role , $request){
        // return $request->permissions;
        $role = Role::find($role);
        $role->syncPermissions(array_map('intval',$request->permissions));
        return $role->permissions;
    }

    public function getRolePermissions($role){

        return Role::find($role)->permissions;
    }

    public function destroyRole($role){
        return Role::find($role)->delete();
    }


}