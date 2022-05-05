<?php

namespace App\Domain\Addresses\Models\Factories;

use App\Domain\Addresses\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    protected $model = Address::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_from_customer' => $this->faker->word(),
            'city' => $this->faker->city(),
            'street_or_district' => $this->faker->streetName(),
            'house_number' => $this->faker->buildingNumber(),
            'flat_number' => $this->faker->randomNumber(3, false),
        ];
    }
}
