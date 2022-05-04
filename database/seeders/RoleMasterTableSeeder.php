<?php

namespace Database\Seeders;
use App\Models\Role_master;
use Illuminate\Database\Seeder;

class RoleMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                "name" => "Designer",
            ],
            [
                "name" => "Sales Rep",
            ],
            [
                "name" => "Printer",
            ],
            [
                "name" => "Finisher",
            ],
            [
                "name" => "Loom Operater",
            ],
            [
                "name" => "Finishing Operater",
            ],
            [
                "name" => "Quality Checkers",
            ],
        ];

        foreach ($roles as $role) {
            Role_master::create($role);
        }
    }
}
