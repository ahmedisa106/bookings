<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Enums\UserRoleEnum;
use Modules\Users\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name'          =>  fake()->userName(),
                'email'         =>  'admin@project.com',
                'role'          =>  UserRoleEnum::ADMIN, // admin
                'password'      =>  bcrypt('password'),
                'created_at'    =>  now(),
                'updated_at'    =>  now()
            ],
            [
                'name'          =>  fake()->userName(),
                'email'         =>  'provider@project.com',
                'role'          =>  UserRoleEnum::PROVIDER, // provider
                'password'      =>  bcrypt('password'),
                'created_at'    =>  now(),
                'updated_at'    =>  now()
            ],
            [
                'name'          =>  fake()->userName(),
                'email'         =>  'customer@project.com',
                'role'          =>  UserRoleEnum::CUSTOMER, // customer
                'password'      =>  bcrypt('password'),
                'created_at'    =>  now(),
                'updated_at'    =>  now()
            ],
        ]);
    }
}
