<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Arturo Carmona',
            'email'=> 'jessarturo97@gmail.com',
            'password'=> bcrypt('12345678'),
        ]);
    }
}
