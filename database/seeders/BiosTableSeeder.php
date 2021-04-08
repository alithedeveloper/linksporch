<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bios')->insert($this->bios());
    }
    private function bios()
    {
        return [
            [
                'user_id'     => 1,
                'title'       => 'Connect with me',
                'slug'        => 'connect-with-me',
                'description' => 'You can follow me on social media',
                'url'         => 'https://ali.shah',
                'is_public'   => true,
            ],
            [
                'user_id'     => 1,
                'title'       => 'Dev Bio',
                'slug'        => 'dev-bio',
                'description' => 'You can follow me on social media',
                'url'         => 'https://gmail.com',
                'is_public'   => true,
            ]
        ];
    }
}
