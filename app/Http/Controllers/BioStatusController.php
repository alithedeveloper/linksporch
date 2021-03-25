<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BioStatusController extends Controller
{
    /**
     * @param  Request  $request
     * @param  Bio  $bio
     */
    public function __invoke(Request $request, Bio $bio)
    {
        $bio->update([
            'is_active' => $request->boolean('is_active')
        ]);

        return Redirect::route('dashboard');
    }
}
