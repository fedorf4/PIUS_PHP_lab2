<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name_from_customer' => $this->faker->word(),
            'city' => $this->faker->city(),
            'street_or_district' => $this->faker->streetName(),
            'house_number' => $this->faker->buildingNumber(),
            'floor' => $this->faker->randomNumber(2, false),
            'flat_number' => $this->faker->randomNumber(3, false),
            'intercom_code' => $this->faker->numerify('B###B##'),
            'customer_id' => Customer::all()->random()->id
        ];
    }
}
