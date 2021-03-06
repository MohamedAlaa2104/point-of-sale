<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = Role::create(['name'=>'Super Admin']);
        Role::create(['name'=>'User']);
        $permissions = Permission::pluck('id')->all();
        $role->syncPermissions($permissions);
    }
}
