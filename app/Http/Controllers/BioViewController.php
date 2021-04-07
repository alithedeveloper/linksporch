<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use App\Models\User;
use Inertia\Inertia;

class BioViewController extends Controller
{
    public function __invoke(User $user, Bio $bio)
    {
        return Inertia::render('Bio/View', [
            'user' => $user,
            'bio'  => $bio->load([
                'links' => function($query){
                    $query->with(['svg' => function($query){
                        $query->toBase()->select('id','markup');
                    }])->latest();
                },
                'image'
            ])
        ]);
    }
}
