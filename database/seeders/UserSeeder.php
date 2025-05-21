<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new \App\Models\User();
        $user->name = 'Operator';
        $user->email = 'operator@pertagas.com';
        $user->email_verified_at = now();
        $user->password = '1234';
        $user->role = '2'; //admin
        $user->verified = true;
        $user->save();
    }
}
