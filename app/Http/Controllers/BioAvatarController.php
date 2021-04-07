<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class BioAvatarController extends Controller
{
    /**
     * @param  Bio  $bio
     * @param  Request  $request
     */
    public function store(Bio $bio,Request $request)
    {
        $request->file([
            'avatar' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('avatar')->store('avatars');

        if (optional($bio->image)->name) {
            Storage::disk('public')->delete($bio->image->name);
            $bio->image()->delete();
        }

        $bio->image()->create([
            'user_id' => auth()->user()->id,
            'path'    => 'storage/'.$path,
            'name'    => $path
        ]);

        return Redirect::route('bio.appearance', [$bio->slug]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param  Bio  $bio
     * @param $avatar
     */
    public function destroy(Bio $bio, $avatar)
    {
        if (!$bio->image()->exists()) {
            return Redirect::route('bio.appearance', [$bio->slug]);
        }
        Storage::disk('public')->delete($bio->image->name);
        $bio->image()->delete();

        return Redirect::route('bio.appearance', [$bio->slug]);
    }
}
