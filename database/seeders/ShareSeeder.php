<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $store = [];
        $included = false;
        for ($i = 0; $i < 50; $i++) {
            do {
                $user_id =  fake()->numberBetween(1, 10);
                $post_id = fake()->numberBetween(1, 50);
                if (isset($store[$user_id])) {                  
                    if (in_array($post_id, $store[$user_id])) {
                        $included = true;
                    } else {
                        array_push($store[$user_id], $post_id);
                        $included = false;
                    }
                } else {
                    $store[] = [$user_id];
                    $included = false;
                }
                foreach ($store as $key => $value) {
                }
            } while ($included);

            $data[] = [
                'user_id' => $user_id,
                'post_id' => $post_id,
                'date' => fake()->date()
            ];
        }

        DB::table('shares')->insert($data);
    }
    
}
