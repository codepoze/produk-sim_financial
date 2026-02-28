<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert users
        $user           = new User();
        $user->id_users = '1';
        $user->name     = 'Alan Saputra Lengkoan';
        $user->email    = 'alanlengkoan@gmail.com';
        $user->roles    = 'users';
        $user->active   = 'y';
        $user->password = '$2y$10$kYtHSUrj9tFz17XikkGqcu232LxX5ueKl6oxnKcbjr9ch9ZO48YgG';
        $user->save();
    }
}
