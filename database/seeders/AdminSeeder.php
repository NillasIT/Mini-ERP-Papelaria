<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Nilton Matias Nhanteme',
            'email' => 'nilton.matias@icloud.com',
            'phone' => '+258 87 774 0104',
            'password' =>hash::make('machavasede14'),
            'role' => 'Administrador',
        ]);
    }
}
