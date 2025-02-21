<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // first method for adding a super admin by { Model }
        User::create([
            'name' => 'Yasin',
            'email' => 'yasin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'gender' => 'male',


        ]);
        User::create([
            'name' => 'Joudy',
            'email' => 'joudy@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'gender' => 'female',

        ]);
        User::create([
            'name' => 'Wessal',
            'email' => 'wessal@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'gender' => 'female',
        ]);
        User::create([
            'name' => 'mona',
            'email' => 'mona@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'parent',
            'gender' => 'female',
        ]);
    }
}
