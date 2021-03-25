<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request
     */
    public function __invoke(Request $request): Response
    {
        $bios = Bio::where('user_id', $request->user()->id)->get();

        return Inertia::render('Dashboard', [
            'bios' => $bios
        ]);
    }
}
