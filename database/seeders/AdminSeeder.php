<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'name'=>'SuperAdmin',
            'email'=>'SuperAdmin@app.com',
            'password'=>bcrypt('12345678'),
        ]);
        $role = Role::where('name', 'Super Admin')->pluck('id');
        $user->assignRole($role);
    }
}
