<?php

namespace Domain\Gamification\Database\Factories;

use Domain\Gamification\Models\PointAction;
use Illuminate\Database\Eloquent\Factories\Factory;

class PointActionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PointAction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'action_name' => $this->faker->word,
            'points' => $this->faker->numberBetween(1, 100),
        ];
    }
}
