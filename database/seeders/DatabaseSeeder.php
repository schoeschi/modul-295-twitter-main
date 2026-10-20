<?php

namespace Database\Seeders;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Random\RandomException;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws RandomException
     */
    public function run(): void
    {
        User::factory()
            ->count(20)
            ->has(
                Tweet::factory()
                    ->count(random_int(0, 50))
            )
            ->create();

        User::first()->update([
            "email" => "user@example.com",
            "password" => bcrypt("password")
        ]);
    }
}
