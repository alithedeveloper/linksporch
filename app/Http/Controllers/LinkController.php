<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{
    public function store(Bio $bio)
    {
        $bio->links()->create([
           'link_type_id' => 1,
            'title' => '',
            'url'  => '',
            'is_active' => false,
            'schedule'  => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        return Redirect::route('bio.show', [$bio->slug]);
    }
}
