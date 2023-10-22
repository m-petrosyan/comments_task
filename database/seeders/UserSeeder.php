<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(['email' => 'user@gmail.com'], [
            'name' => 'John Doe',
            'email' => 'user@gmail.com',
            'password' => '12345678',
        ]);

        User::factory()->count(5)->create();
    }
}
