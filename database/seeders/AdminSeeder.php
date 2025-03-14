<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $password = fake()->password();
        User::create( [
            'name' => 'admin',
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);
        echo $password;
    }
}
