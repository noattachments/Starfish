<?php

namespace Domain\Gamification\Database\Seeders;

use Domain\Gamification\Models\PointAction;
use Illuminate\Database\Seeder;

class PointActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        PointAction::create([
            'action_name' => 'Daily Login',
            'points' => 10,
            'description' => 'Earn points for logging in daily.',
        ]);

        PointAction::create([
            'action_name' => 'Task Completed',
            'points' => 50,
            'description' => 'Earn points for completing a task.',
        ]);
    }
}
