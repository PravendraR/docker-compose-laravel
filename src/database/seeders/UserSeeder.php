<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_list = Permission::create(['name'=>'user.list']);
        $user_verifyuser = Permission::create(['name'=>'user.verifyuser']);
        $user_register = Permission::create(['name'=>'user.register']);
        $user_login = Permission::create(['name'=>'user.login']);

        $admin_role = Role::create(['name'=>'admin']);

        $admin_role->givePermissionTo([
            $user_list,
            $user_verifyuser,
            $user_register,
            $user_login
        ]);
        $query = [
            'userName' => 'PRAVENDRA',
            'password' => 'pravendra',
            'status' => 1,
            'companyId' => 1
        ];
        $admin = User::create($query);
        $admin->assignRole($admin_role);
        $admin->givePermissionTo([
            $user_list,
            $user_verifyuser,
            $user_register,
            $user_login
        ]);
        $query = [
            'userName' => 'PRAVENDRAA',
            'password' => 'pravendra',
            'status' => 1,
            'companyId' => 1
        ];
        $user_role = Role::create(['name'=>'user']);
        $user = User::attempt($query);
        $user->assignRole($user_role);
        $user->givePermissionTo([
            $user_list
        ]);
    }
}
