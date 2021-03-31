<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinksController extends Controller
{
    public function index(Bio $bio)
    {
        dd($bio);
    }

    public function delete(Link $link)
    {
        $bioSlug = $link->bio->slug;

        $link->delete();

        return Redirect::route('bio.show',[$bioSlug]);
    }
}
