<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            'settings',
            'read roles',
            'create roles',
            'edit roles',
            'delete roles',
            'read user',
            'create user',
            'edit user',
            'delete user',
            'read services',
            'create services',
            'edit services',
            'delete services',
            'read agencies',
            'create agencies',
            'edit agencies',
            'delete agencies',
            'read products',
            'create products',
            'edit products',
            'delete products',
            'read orders',
            'delete orders',
            'read articles',
            'create articles',
            'edit articles',
            'delete articles',
            'read customers',
            'create customers',
            'edit customers',
            'delete customers',
            'read gallery',
            'create gallery',
            'edit gallery',
            'delete gallery',
            'read jobs',
            'create jobs',
            'edit jobs',
            'delete jobs',
            'read contactus',
            'delete contactus',
        ];
        foreach ($permissions as $row){
            Permission::create(['name'=>$row]);
        }
    }
}
