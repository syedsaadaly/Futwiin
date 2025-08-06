<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\Plan;
use App\Models\PredictionDetail;
use App\Models\Pridection;
use App\Models\PridectionDetail;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            $users[] = User::create([
                'first_name' => 'User'.$i,
                'last_name' => 'Last'.$i,
                'email' => 'user'.$i.'@example.com',
                'password' => Hash::make('password'),
                'wallet' => 100.00,
                'plan_id' => null,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        }

        $users[0]->assignRole('admin');
        for ($i = 1; $i <= 4; $i++) {
            $users[$i]->assignRole('user');
        }

        $plans = [];
        for ($i = 1; $i <= 5; $i++) {
            $plans[] = Plan::create([
                'name' => 'Plan '.$i,
                'text' => 'This is plan number '.$i,
                'price' => ($i * 1000),
                'points' => ($i * 500),
                'predicted_view_duration_offset' => ($i * 30),
            ]);
        }

        $teams = [];
        $teamNames = ['Arsenal', 'Barcelona', 'Chelsea', 'Dortmund', 'Everton'];
        foreach ($teamNames as $name) {
            $teams[] = Team::create([
                'name' => $name,
            ]);
        }

        $leagues = [];
        $leagueData = [
            ['Premier League', 2],
            ['Champions League', 1],
            ['La Liga', 2],
            ['World Cup', 1],
            ['Bundesliga', 2]
        ];

        foreach ($leagueData as $data) {
            $leagues[] = League::create([
                'title' => $data[0],
                'text' => 'Description for '.$data[0],
                'league_date' => now()->addDays(rand(10, 100)),
                'type' => $data[1],
            ]);
        }

        $predictions = [];
        for ($i = 1; $i <= 5; $i++) {
            $predictions[] = Pridection::create([
                'team_1_id' => $teams[array_rand($teams)]->id,
                'team_2_id' => $teams[array_rand($teams)]->id,
                'title' => 'Match Prediction '.$i,
                'text' => 'Detailed analysis for match '.$i,
                'match_date' => now()->addDays($i),
                'match_time' => now()->addHours($i)->format('H:i:s'),
                'is_teaser' => ($i % 2 == 0),
            ]);
        }

        foreach ($predictions as $prediction) {
            foreach ($plans as $plan) {
                PredictionDetail::create([
                    'prediction_id' => $prediction->id,
                    'plan_id' => $plan->id,
                    'points_deduction' => rand(10, 50),
                ]);
            }
        }

        $this->command->info('Sample data seeded successfully!');
    }
}
