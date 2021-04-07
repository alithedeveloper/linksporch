<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BiosController extends Controller
{
    /**
     * @param  Bio  $bio
     * @return \Inertia\Response
     */
    public function show(Bio $bio)
    {
        $bio->load(['links' => function($query){
            $query->latest();
        }]);

        return Inertia::render('Bio/Show', [
            'bio' => $bio
        ]);
    }

    /**
     * @param  Bio  $bio
     * @param  Request  $request
     */
    public function update(Bio $bio, Request $request)
    {

    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'slug'  => 'required'
        ]);

        Auth::user()->bios()->create([
            'title' => $request->input('title'),
            'slug'  =>  $request->input('slug'),
            'url'   => bio_url(
                $request->user()->username,
                $request->input('slug')
            ),
            'is_public' => false,
            'is_active' => false,
            'scheduled_at' => Carbon::now()->toDateTimeString()
        ]);

        return Redirect::route('bio.appearance', [
            $request->input('slug')
        ]);
    }

}
