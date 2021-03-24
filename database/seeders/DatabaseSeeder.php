<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory()->create();
         $this->call(BiosTableSeeder::class);
         $this->call(LinkTypeTableSeeder::class);
         $this->call(LinkTableSeeder::class);
    }
}
