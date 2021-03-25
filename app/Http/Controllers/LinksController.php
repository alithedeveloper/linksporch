<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index(Bio $bio)
    {
        dd($bio);
    }
}
