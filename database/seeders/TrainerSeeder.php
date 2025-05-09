<?php

namespace Database\Seeders;

use App\Models\Trainer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create main trainer (admin trainer)
        $trainerUser = User::create([
            'name' => 'John Trainer',
            'email' => 'trainer@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        Trainer::create([
            'user_id' => $trainerUser->id
        ]);

        // Create additional trainers
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "Trainer {$i}",
                'email' => "trainer{$i}@example.com",
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

            Trainer::create([
                'user_id' => $user->id
            ]);
        }
    }
}