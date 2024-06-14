<?php

namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
  
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
           'Admin',
           'User',
        ];
        
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // find admin role
        $roleAdmin = Role::where('name', 'Admin')->first();

        // set all access to admin
        $permissionsId = Permission::pluck('id')->all();

        $roleAdmin->syncPermissions($permissionsId);


        // find admin role
        $roleUser = Role::where('name', 'User')->first();

        $permissionsIdUser = Permission::whereIn('name', ['blog-post:list'])->pluck('id')->all();
        $roleUser->syncPermissions($permissionsIdUser);

    }
}