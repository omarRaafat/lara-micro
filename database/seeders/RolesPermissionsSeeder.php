<?php

namespace Database\Seeders;

// use App\Models\Role;
// use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission::truncate();
        $permissions = [
            ['name' =>  ['ar' =>'إضافه دور' , 'en' => 'create role'] , 'guard_name' => 'api'],
            ['name' =>  ['ar' =>'تعديل دور' , 'en' => 'edit role'] , 'guard_name' => 'api'],
            ['name' =>  ['ar' =>'حذف دور' , 'en' => 'delete role']  , 'guard_name' => 'api'],
            ['name' =>  ['ar' =>'عرض دور' , 'en' => 'show role'] , 'guard_name' => 'api'],
            ['name' =>  ['ar' =>'إضافة تصيريح' , 'en' => 'create permission'] , 'guard_name' => 'api'],
            ['name' =>  ['ar' =>'تعديل تصيريح' , 'en' => 'edit permission'] , 'guard_name' => 'api'],
            ['name' =>  ['ar' =>'حذف تصيريح' , 'en' => 'delete permission'] , 'guard_name' => 'api'],
            ['name' =>  ['ar' =>'عرض تصيريح' , 'en' => 'show permission'] , 'guard_name' => 'api'],
          
        ];

        foreach($permissions as $permission)
        Permission::create($permission);

        $role = Role::create([
            'name' => ['ar' =>'مدير عام' , 'en' => 'admin'],
            'guard_name' => 'api',
        ]);

        $role->givePermissionTo(Permission::all());
        User::find(1)->assignRole($role);
       

    }
}
