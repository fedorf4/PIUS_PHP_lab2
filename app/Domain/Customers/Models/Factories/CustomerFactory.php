<?php

namespace App\Domain\Customers\Models\Factories;

use App\Domain\Addresses\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Customers\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'address_id' => Address::all()->random()->id,
        ];
    }
}
