<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // query, builder, db
    // eloquent / ORM
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com', 
            'password' => 12345678
        ]);
    }
}
