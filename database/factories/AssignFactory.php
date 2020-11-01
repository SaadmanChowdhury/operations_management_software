<?php

namespace Database\Factories;

use App\Models\Assign;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Assign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 10),
            'year' => $this->faker->numberBetween(2000, 2030),
            'month' => $this->faker->numberBetween(1, 12),
            'plan_month_year' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 100),
            'execution' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 100),
        ];
    }
}
