<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_name' => $this->faker->name,
            'client_id' => $this->faker->numberBetween(1, 100),
            'manager_id' => $this->faker->numberBetween(1, 100),
            'order_month' => $this->faker->date,
            'inspection_month' => $this->faker->date,
            'order_status' => $this->faker->numberBetween(1, 10),
            'business_situation' => $this->faker->numberBetween(1, 10),
            'development_stage' => $this->faker->numberBetween(1, 10),
            'sales_total' => $this->faker->numberBetween(100000, 10000000),
            'transferred_amount' => $this->faker->numberBetween(1000, 100000),
        ];
    }
}
