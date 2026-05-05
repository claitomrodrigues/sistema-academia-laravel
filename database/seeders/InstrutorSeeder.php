<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InstrutorSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'instrutor@academia.com'],
            [
                'name' => 'InstrutorAdmin',
                'password' => Hash::make('12345678'),
                'role' => 'instrutor',
            ]
        );
    }
}