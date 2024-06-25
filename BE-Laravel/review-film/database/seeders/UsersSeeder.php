<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Roles::where('name', 'admin')->first();
        $user = Str::random(10);

        User::create([
            'name' => $user,
            'email' => $user . '@gmail.com',
            'password' => Hash::make('root'),
            'role_id' => $roleAdmin->id
        ]);
    }
}
