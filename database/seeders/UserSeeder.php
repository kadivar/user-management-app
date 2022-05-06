<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::user_factory()->count(10)->create()->each(function ($user) {
            $total_users_count = User::all()->count();
            if ($total_users_count >= 10) {
                $random_friend = User::all()->random()->id;
                $user->friends()->attach([$random_friend]);
            }
        });
    }
}
