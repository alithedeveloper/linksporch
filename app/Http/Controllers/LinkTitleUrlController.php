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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(Request $request, Link $link): RedirectResponse
    {
        $fieldsToUpdate = [];

        if ($request->has('title')) {
            $fieldsToUpdate = $this->prepareTitle($request);
        }

        if ($request->has('url')) {
            $fieldsToUpdate = $this->prepareUrl($request);
        }

        $link->forceFill($fieldsToUpdate)->save();

        return Redirect::route('bio.show', [$link->bio->slug]);
    }

    /**
     * @param  Request  $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function prepareTitle(Request $request): array
    {
        $this->validate($request,
            ['title' => ['required', 'max:50']],
            ['title.required' => 'Title is required']
        );

        return [
            'title' => $request->input('title')
        ];
    }

    /**
     * @param  Request  $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function prepareUrl(Request $request): array
    {
        $this->validate($request,
            ['url' => ['required', 'url']],
            [
                'url.required' => 'Url is required',
                'url.url'      => "Url is invalid"
            ]
        );
        return [
            'url' => $request->input('url')
        ];
    }
}
