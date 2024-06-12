<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_id' => $this->faker->numberBetween(1, 50),
            'name' => $this->faker->name,
            'brand' => $this->faker->text,
            'category' => $this->faker->text,
            'price' => $this->faker->numberBetween(1500, 6000),
        ];
    }
}
