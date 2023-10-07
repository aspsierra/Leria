<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FollowersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $store = [];

        $n_users = DB::table('users')->count();
        $user = 1;

        while ($user <= 10) {
            for ($i = 0; $i < fake()->numberBetween(1, $n_users); $i++) {
                Log::channel('daily')->info($i);
                do {
                    $rndUser = fake()->numberBetween(1, $n_users);
                } while ($user === $rndUser || in_array($rndUser, $store));
                $store[] = $rndUser;

                $data[] = [
                    'user_id' => $user,
                    'follower_id' => $rndUser,
                    'date' => fake()->date()
                ];
            }
            $store = [];
            $user ++;
        }

        DB::table('followers')->insert($data);


    }
}
