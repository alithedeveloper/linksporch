<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\Svg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class LinkIconController extends Controller
{
    /**
     * @param  Link  $link
     * @param  Request  $request
     * @throws ValidationException
     */
    public function __invoke(Link $link, Request $request)
    {
        $svg = Svg::where('name', $request->searchTerm)->first();

        if (!$svg) {
            throw ValidationException::withMessages([
                'svg' => ['Sorry! That icon doesn\'t exist']
            ]);
        }

        $link->update([
            'svg_id' => $svg->id
        ]);

        return Redirect::route('bio.show',[$link->bio->slug]);
    }
}
