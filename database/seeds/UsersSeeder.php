<?php

use App\Models\User;
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
            'email' => 'hasib.mahmudul@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
