<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Seller;
use App\Models\SubscriptionPlan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SellerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seller::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "first_name" => $this->faker->firstName,
            "last_name" => $this->faker->lastName,
            "email" => $this->faker->email,
            "email_verified_at" => now(),
            "password" => "password",
            "remember_token" => Str::random(10),
            "address_line" => $this->faker->address,
            "location_id" => City::inRandomOrder()->value("id"),
            "postal_code" => $this->faker->postcode,
            "subscription_plan_id" => SubscriptionPlan::inRandomOrder()->value(
                "id"
            ),
        ];
    }
}
