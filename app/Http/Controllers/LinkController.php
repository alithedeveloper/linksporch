<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{
    public function store(Bio $bio)
    {
        $bio->links()->create([
           'link_type_id' => 1,
            'title' => '',
            'description' => '',
            'icon' => '',
            'url'  => '',
            'is_active' => false,
            'text_color' => '#3456787',
            'background_color' => '#345678'
        ]);

        return Redirect::route('bio.show', [$bio->slug]);
    }
}
