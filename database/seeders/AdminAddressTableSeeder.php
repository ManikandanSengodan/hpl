<?php

namespace Database\Seeders;
use App\Models\Admin_address;
use Illuminate\Database\Seeder;

class AdminAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = [
            [
                "admin_id" => "1",
                "fullname" => "Manikandan S",
                "flatno" => "#34",
                "apartment" => "Mk apaetment",
                "landmark" => "Near Cell shop",
                "area" => "Anna Nagar",
                "zipcode" => "600012",
                "city" => "Chennai",
                "country" => "India",
                "state" => "TamilNadu",

            ],
            [
                "admin_id" => "2",
                "fullname" => "Gunasekaran G",
                "flatno" => "#34",
                "apartment" => "Mk apaetment",
                "landmark" => "Near Cell shop",
                "area" => "Anna Nagar",
                "zipcode" => "600012",
                "city" => "Chennai",
                "country" => "India",
                "state" => "TamilNadu",

            ],
        ];

        foreach ($address as $user) {
            Admin_address::create($user);
        }
    
    }
}
