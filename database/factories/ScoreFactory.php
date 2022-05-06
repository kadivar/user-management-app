<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Score;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserResource>
 */
class ScoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Score::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'source_id' => User::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'score' => $this->faker->randomElement([-3, -2, -1, 0, 1, 2, 3]),
        ];
    }

}
