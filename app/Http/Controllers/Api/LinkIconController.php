<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\Svg;
use Illuminate\Http\Request;

class LinkIconController extends Controller
{

    public function __invoke(Link $link, Request $request)
    {
        $svg = Svg::where('name', $request->searchTerm)->first();

        if (!$svg) {
            return response()->json([
                'message' => 'Svg doesnt exist'
            ], 422);
        }
        $link->update([
            'svg_id' => $svg->id
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }
}
