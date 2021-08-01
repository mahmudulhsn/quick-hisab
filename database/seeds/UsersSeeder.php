<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'M H Hasib',
            'email' => 'hasibkln55@gmail.com',
            'password' => Hash::make('QuickMart321'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
