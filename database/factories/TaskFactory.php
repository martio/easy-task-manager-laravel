<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Task\StatusEnum;
use App\Helpers\Facades\Uid;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Override;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[Override]
    public function definition(): array
    {
        return [
            'id' => Uid::generate(),
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(nbWords: 3),
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(array: [
                StatusEnum::Pending,
                StatusEnum::InProgress,
                StatusEnum::Completed,
            ]),
        ];
    }

    /**
     * Indicate that the model's email address should be pending.
     */
    public function pending(): static
    {
        return $this->state(state: fn (array $attributes): array => [
            'status' => StatusEnum::Pending,
        ]);
    }

    /**
     * Indicate that the model's email address should be in progress.
     */
    public function inProgress(): static
    {
        return $this->state(state: fn (array $attributes): array => [
            'status' => StatusEnum::InProgress,
        ]);
    }

    /**
     * Indicate that the model's email address should be completed.
     */
    public function completed(): static
    {
        return $this->state(state: fn (array $attributes): array => [
            'status' => StatusEnum::Completed,
        ]);
    }
}
