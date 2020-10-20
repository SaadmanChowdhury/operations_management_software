<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'company' => $this->faker->numberBetween(1, 10),
            'commercial_distribute' => $this->faker->company,
            'tel' => $this->faker->phoneNumber,
            'position' => $this->faker->numberBetween(1, 10),
            'admission_day' => $this->faker->date,
            'exit_day' => $this->faker->date,
            'unit_price' => $this->faker->numberBetween(100, 1000),
            'user_authority' => $this->faker->numberBetween(10, 50),
            'delete_day' => $this->faker->date,
        ];
    }
}