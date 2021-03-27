<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BiosController extends Controller
{
    public function show(Bio $bio)
    {
        $bio->load(['links' => function($query){
            $query->latest();
        }]);

        return Inertia::render('Bio/Show', [
            'bio' => $bio
        ]);
    }

    public function update(Bio $bio, Request $request)
    {

    }

}
