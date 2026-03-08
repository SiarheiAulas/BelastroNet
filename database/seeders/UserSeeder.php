<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'name' => 'TestUser',
            'email' => 'test@example.com',
            'password'=>Hash::make('123')
        ]);
        
        $user->assignRole('admin');

        $user2 = User::create([
            'name' => 'TestUser2',
            'email' => 'test2@example.com',
            'password'=>Hash::make('321')
        ]);
        
        $user2->assignRole('user');
    }
}
