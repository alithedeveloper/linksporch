<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinkTitleUrlController extends Controller
{
    /**
     * @param  Request  $request
     * @param  Link  $link
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Link $link): RedirectResponse
    {
        $this->validate($request,
            [
                'title' => ['required', 'max:50'],
                'url'   => ['required', 'url']
            ],
            [
                'title.required' => 'Title is required',
                'url.required'   => 'Url is required',
                'url.url'        => "Url is invalid"
            ]
        );

        $link->forceFill([
            'title' => $request->input('title'),
            'url'   => $request->input('url')
        ])->save();

        return Redirect::route('bio.show', [$link->bio->slug]);
    }
}
