<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(table: 'users')->insert(values: [
            [
                'id' => '01hhfvr3xey1ppjqftjfytf1gq',
                'name' => 'Marcin Lewandowski',
                'email' => 'marcin.martio.lewandowski@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make(value: '123$TesT$321'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
