<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('link_types')->insert($this->linkTypes());
    }


    protected function linkTypes()
    {
        return [
            [
                'name'        => 'Text',
                'description' => 'Text Description'
            ],
            [
                'name'        => 'Image',
                'description' => 'Image Description'
            ],
            [
                'name'        => 'Youtube',
                'description' => 'Youtube Description'
            ],
            [
                'name'        => 'Vimeo',
                'description' => 'Vimeo Description'
            ],
            [
                'name'        => 'Music',
                'description' => 'Music Description'
            ]
        ];
    }
}
