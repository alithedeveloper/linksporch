<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->insert($this->links());
    }

    protected function links()
    {
        return [
            [
                'bio_id'           => 1,
                'link_type_id'     => 1,
                'title'            => 'Facebook',
                'url'              => 'https://www.facebook.com',
            ],
            [
                'bio_id'           => 1,
                'link_type_id'     => 2,
                'title'            => 'Twitter',
                'url'              => 'https://www.twitter.com',
            ],
            [
                'bio_id'           => 1,
                'link_type_id'     => 1,
                'title'            => 'Instagram',
                'url'              => 'https://www.instagram.com',
            ],
            [
                'bio_id'           => 1,
                'link_type_id'     => 3,
                'title'            => 'Youtube',
                'url'              => 'https://www.youtube.com',
            ]
        ];
    }
}
