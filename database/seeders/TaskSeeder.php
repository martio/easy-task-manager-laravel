<?php

namespace Database\Seeders;

use App\Enums\Task\StatusEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(table: 'tasks')->insert(values: [
            [
                'id' => '01hhfvxphs840vvjwnf61j0rdg',
                'user_id' => '01hhfvr3xey1ppjqftjfytf1gq',
                'title' => 'Lorem ipsum dolor sit amet 1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'status' => StatusEnum::Completed->state(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '01hhfvxqe8v5rnhhfkpsk01kg5',
                'user_id' => '01hhfvr3xey1ppjqftjfytf1gq',
                'title' => 'Lorem ipsum dolor sit amet 2',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'status' => StatusEnum::InProgress->state(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '01hhfvxrbxgcgzv055xpmsyh8y',
                'user_id' => '01hhfvr3xey1ppjqftjfytf1gq',
                'title' => 'Lorem ipsum dolor sit amet 3',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'status' => StatusEnum::Pending->state(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
