<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'username' => 'admin',
                'nama_lengkap' => 'Administrator',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('nia2026')
            ],
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
