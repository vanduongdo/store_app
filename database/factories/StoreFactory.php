<?php

namespace Database\Factories;

use App\Models\Store;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->text,
            'address' => $this->faker->streetAddress,
        ];
    }
}
