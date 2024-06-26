<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('password'),
        ]);

        $permissions = Permission::all();

        $role = Role::where('name', 'admin')->first();

        $role->syncPermissions($permissions);

        $user->assignRole($role);

        $user = User::create([
            'name'      => 'User Satu',
            'email'     => 'user@gmail.com',
            'password'  => bcrypt('password'),
        ]);

        $permissions = Permission::all();

        $role = Role::where('name', 'user')->first();

        $role->syncPermissions($permissions);

        $user->assignRole($role);
    }
}
