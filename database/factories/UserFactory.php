<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $faker = Faker::create();
        $data = [];

        $startDate = Carbon::createFromFormat('Y-m-d', '2024-01-01');
        $endDate = Carbon::createFromFormat('Y-m-d', '2024-04-01');
        
        // Loop untuk membuat 10 user faker
        for ($i = 0; $i < 10; $i++) {
            $data = [
                'name' => $faker->name,
                'email' => Str::random(10).'@com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Ganti dengan password yang diinginkan
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'profile_photo_path' => null,
                'created_at' => Carbon::instance($this->getRandomDate($startDate, $endDate)),
                'updated_at' => Carbon::instance($this->getRandomDate($startDate, $endDate)),
            ];
        }
        return $data;
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     */
    public function withPersonalTeam(callable $callback = null): static
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(fn (array $attributes, User $user) => [
                    'name' => $user->name.'\'s Team',
                    'user_id' => $user->id,
                    'personal_team' => true,
                ])
                ->when(is_callable($callback), $callback),
            'ownedTeams'
        );
    }
    private function getRandomDate($startDate, $endDate)
    {
        $randomTimestamp = mt_rand($startDate->timestamp, $endDate->timestamp);
        return Carbon::createFromTimestamp($randomTimestamp);
    }
}