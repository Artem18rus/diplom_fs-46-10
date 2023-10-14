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
    public function run(): void
    {
        $user = User::create([
            'name'     => 'admin2',
            'email'    => 'admin2@mail.ru',
            'password' => bcrypt('12345678'),
        ]);

        $user->roles()->attach(1);
    }
}
