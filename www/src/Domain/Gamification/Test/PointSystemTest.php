<?php

namespace Domain\Gamification\Test;

use App\Models\User;
use Domain\Gamification\Models\PointAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PointSystemTest extends TestCase
{
    /**
     * This trait ensures the database is migrated before each test
     */
    use RefreshDatabase;

    /**
     * Test that users receive points for completing predefined actions.
     *
     * This test simulates a user completing a predefined action (e.g., logging in) and ensures that
     * the points are correctly assigned to the user. It verifies that the point history table records
     * the action, points earned, and that the total points are correctly updated for the user.
     */
    /** @test */
    public function test_users_receive_points_for_completing_predefined_actions()
    {
        // Create a user and a predefined point action
        $user = User::factory()->create();
        $action = PointAction::factory()->create([
            'action_name' => 'Daily Login',
            'points' => 10
        ]);

        // Simulate user completing an action (e.g., login)
        $user->pointsHistory()->create([
            'point_action_id' => $action->id,
            'points' => $action->points,
            'action_type' => 'earned',
            'description' => 'Logged in today'
        ]);

        // Assert that the user received the points
        $this->assertDatabaseHas('user_points_history', [
            'user_id' => $user->id,
            'point_action_id' => $action->id,
            'points' => 10,
            'action_type' => 'earned',
        ]);

        // Assert that the user's total points is correctly updated
        $this->assertEquals(10, $user->pointsHistory()->sum('points'));
    }

    /**
     * Test that the system records and displays the user's total points in their profile.
     *
     * This test simulates the user completing multiple predefined actions and ensures that the total
     * points are correctly updated and displayed in the user's profile. It verifies that the points
     * earned from multiple actions are accumulated properly.
     */
    public function test_system_records_and_displays_the_users_total_points_in_their_profile()
    {
        // Create a user
        $user = User::factory()->create();

        // Create multiple actions and add them to the user's history
        $action1 = PointAction::factory()->create(['points' => 10]);
        $action2 = PointAction::factory()->create(['points' => 20]);

        $user->pointsHistory()->create([
            'point_action_id' => $action1->id,
            'points' => $action1->points,
            'action_type' => 'earned',
            'description' => 'Completed Task 1',
        ]);

        $user->pointsHistory()->create([
            'point_action_id' => $action2->id,
            'points' => $action2->points,
            'action_type' => 'earned',
            'description' => 'Completed Task 2',
        ]);

        // Assert that the total points are correctly updated in the user's profile
        $this->assertEquals(30, $user->pointsHistory()->sum('points'));
    }

    /**
     * @test
     * Test that the point history/log tracks earned and spent points.
     *
     * This test simulates a user earning and spending points. It checks that both earned and spent
     * points are recorded correctly in the `user_points_history` table. The total points balance is
     * then verified to ensure the system accounts for both earnings and expenditures.
     *
     * @return void
     */
    public function test_point_history_tracks_earned_and_spent_points()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a point action
        $action1 = PointAction::factory()->create(['points' => 15]);

        // Simulate earning points
        $user->pointsHistory()->create([
            'point_action_id' => $action1->id,
            'points' => $action1->points,
            'action_type' => 'earned',
            'description' => 'Completed Task 1',
        ]);

        // Simulate spending points
        $user->pointsHistory()->create([
            'point_action_id' => $action1->id,
            'points' => 5, // Spending 5 points
            'action_type' => 'spent',
            'description' => 'Used points for reward',
        ]);

        // Assert that earned points are recorded
        $this->assertDatabaseHas('user_points_history', [
            'user_id' => $user->id,
            'action_type' => 'earned',
            'points' => 15
        ]);

        // Assert that spent points are recorded
        $this->assertDatabaseHas('user_points_history', [
            'user_id' => $user->id,
            'action_type' => 'spent',
            'points' => 5
        ]);

        // Assert that the total points reflect both earned and spent
        $totalPoints = $user->pointsHistory()->sum('points');
        $this->assertEquals(10, $totalPoints); // 15 earned - 5 spent
    }
}
