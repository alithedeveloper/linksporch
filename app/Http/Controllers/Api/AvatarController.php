<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    /**
     * @param  Bio  $bio
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Bio $bio, Request $request)
    {
        request()->file([
            'avatar' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('avatar')->store('avatars');

        if (optional($bio->image)->name) {
            Storage::disk('public')->delete($bio->image->name);
            $bio->image()->delete();
        }

        $bio->image()->create([
           'user_id' => auth()->user()->id,
            'path' => 'storage/'. $path,
            'name'  => $path
        ]);

        return response()->json([
            'success' => true
        ]);

    }
}
