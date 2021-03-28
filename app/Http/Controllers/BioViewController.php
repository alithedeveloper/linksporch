<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use App\Models\User;
use Inertia\Inertia;

class BioViewController extends Controller
{
    public function __invoke(User $user,Bio $bio)
    {
        return Inertia::render('Bio/View', [
            'user' => $user,
            'bio' => $bio->load(['links' => fn($query) => $query->latest()])
        ]);
    }
}
