<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        User::create([
            'name' => "director",
            'email' => 'gerardochale01@gmail.com',
            'password' => "12345"
        ])->assignRole('directivo');

        User::create([
            'name' => "maestro",
            'email' => 'gerardochale@hotmail.com',
            'password' => "12345"
        ])->assignRole('docentes');
    }
}
