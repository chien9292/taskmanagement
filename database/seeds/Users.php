<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => 'Tran Minh Chien',
            'email'             => 'chientmse130681@fpt.edu.vn',
            'role'              => consts('user.role.admin'),
            'password'          => Hash::make('123456'),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        DB::table('users')->insert([
            'name'              => 'Manager1',
            'email'             => 'manager1@gmail.com',
            'role'              => consts('user.role.manager'),
            'password'          => Hash::make('123456'),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        DB::table('users')->insert([
            'name'              => 'Manager2',
            'email'             => 'manager2@gmail.com',
            'role'              => consts('user.role.manager'),
            'password'          => Hash::make('123456'),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        DB::table('users')->insert([
            'name'              => 'Chien employee',
            'email'             => 'ck.simple.1412@gmail.com',
            'role'              => consts('user.role.user'),
            'password'          => Hash::make('123456'),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        DB::table('users')->insert([
            'name'              => 'User1',
            'email'             => 'user1@gmail.com',
            'role'              => consts('user.role.user'),
            'password'          => Hash::make('123456'),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        DB::table('users')->insert([
            'name'              => 'User2',
            'email'             => 'user2@gmail.com',
            'role'              => consts('user.role.user'),
            'password'          => Hash::make('123456'),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        DB::table('users')->insert([
            'name'              => 'User3',
            'email'             => 'user3@gmail.com',
            'role'              => consts('user.role.user'),
            'password'          => Hash::make('123456'),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        DB::table('users')->insert([
            'name'              => 'User4',
            'email'             => 'user4@gmail.com',
            'role'              => consts('user.role.user'),
            'password'          => Hash::make('123456'),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
    }
}
