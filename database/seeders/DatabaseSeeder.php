<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('posts');
        // Create posts folder if it does not exist
        Storage::makeDirectory('posts');
        \App\Models\Post::factory(30)->create();
        $this->call(AdminSeeder::class);
    }
}
