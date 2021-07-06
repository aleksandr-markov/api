<?php

namespace Database\Factories;

use App\Models\CurrencyUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CurrencyUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 1),
            'currency_id' => $this->faker->numberBetween(1, 5000),

        ];
    }
}
