<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinkStatusController extends Controller
{
    /**
     * @param  Request  $request
     * @param  Link  $link
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Link $link): RedirectResponse
    {
        $link->forceFill([
            'is_active'  => $request->boolean('is_active'),
            'updated_at' => Carbon::now()->toDateTimeString()
        ])->save();

        return Redirect::route('bio.show', [$link->bio->slug]);
    }
}
