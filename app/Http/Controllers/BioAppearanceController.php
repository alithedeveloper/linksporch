<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BioAppearanceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Bio $bio, Request $request)
    {
       return Inertia::render('Bio/Appearance', [
           'bio' => $bio
       ]);
    }
}
