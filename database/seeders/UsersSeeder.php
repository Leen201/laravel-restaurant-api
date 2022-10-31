<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
                [
                    'id' => 1,
                    'name' => 'admin',
                    'email' => 'admin@mail.com',
                    'password' => Hash::make('0000'),
                    'email_verified_at' => now()
                ]
            ]
        );
    }
}
