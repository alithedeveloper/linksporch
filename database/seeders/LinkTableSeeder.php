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
                'description'      => 'Facebook Description',
                'url'              => 'https://www.facebook.com',
                'text_color'       => '#cecece',
                'background_color' => '#3e3e3e'
            ],
            [
                'bio_id'           => 1,
                'link_type_id'     => 2,
                'title'            => 'Twitter',
                'description'      => 'Twitter Description',
                'url'              => 'https://www.twitter.com',
                'text_color'       => '#cecece',
                'background_color' => '#3e3e3e'
            ],
            [
                'bio_id'           => 1,
                'link_type_id'     => 1,
                'title'            => 'Instagram',
                'description'      => 'Instagram Description',
                'url'              => 'https://www.instagram.com',
                'text_color'       => '#cecece',
                'background_color' => '#3e3e3e'
            ],
            [
                'bio_id'           => 1,
                'link_type_id'     => 3,
                'title'            => 'Youtube',
                'description'      => 'Youtube Description',
                'url'              => 'https://www.youtube.com',
                'text_color'       => '#cecece',
                'background_color' => '#3e3e3e'
            ]
        ];
    }
}
