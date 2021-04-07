<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkScheduleController extends Controller
{
    /**
     * @param  Link  $link
     * @param  Request  $request
     */
    public function __invoke(Link $link,Request $request)
    {
        $request->validate([
           'schedule' => 'required|date_format:Y-m-d H:i'
        ]);

        $link->forceFill([
            'schedule' => $request->input('schedule')
        ])->save();

        return response()->json([
            'success' => true
        ]);
    }
}
