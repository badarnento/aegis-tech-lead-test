<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activeUsers = User::where('is_active', 1)->pluck('id')->toArray();

        if (count($activeUsers) > 0) {
            $faker = Faker::create();

            foreach (range(1, 500) as $index) {
                Order::create([
                    'user_id' => $faker->randomElement($activeUsers),
                    'created_at' => $faker->dateTimeThisYear,
                ]);
            }

            $this->command->info('500 orders have been created!');
        } else {
            $this->command->error('No active users found.');
        }
    }
}
