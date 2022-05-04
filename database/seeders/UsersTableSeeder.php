<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "Manikandan s",
                "email" => "manikandanpwc.work@gmail.com",
                "password" => "password",
            ],
            [
                "name" => "Guna",
                "email" => "guna@yenjoy.in",
                "password" => "password",
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
