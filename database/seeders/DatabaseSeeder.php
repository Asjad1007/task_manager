<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a default test user (Optional for this app since auth isn't strict requirement but good practice)
        User::factory()->create([
            'name' => 'Demo User',
            'email' => 'user@example.com',
        ]);

        // Create Projects
        $workProject = Project::create(['name' => 'Work Projects']);
        $homeProject = Project::create(['name' => 'Home Renovations']);
        $learningProject = Project::create(['name' => 'Learning Laravel']);

        // Create Tasks for Work
        Task::create(['name' => 'Design Database Schema', 'priority' => 1, 'project_id' => $workProject->id]);
        Task::create(['name' => 'Implement API Endpoints', 'priority' => 2, 'project_id' => $workProject->id]);
        Task::create(['name' => 'Write Unit Tests', 'priority' => 3, 'project_id' => $workProject->id]);

        // Create Tasks for Home
        Task::create(['name' => 'Paint the Living Room', 'priority' => 1, 'project_id' => $homeProject->id]);
        Task::create(['name' => 'Fix the Leaky Faucet', 'priority' => 2, 'project_id' => $homeProject->id]);

        // Create Tasks for Learning
        Task::create(['name' => 'Master Eloquent Relationships', 'priority' => 1, 'project_id' => $learningProject->id]);
        Task::create(['name' => 'Build a To-Do App', 'priority' => 2, 'project_id' => $learningProject->id]);
    }
}
