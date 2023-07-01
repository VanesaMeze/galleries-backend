<?php

namespace App\Service;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleriesService {
    /**
     * Display a listing of the resource.
     */
    public function showGalleries()
    {
        $galleries = Gallery::paginate(10);
        $galleries = Gallery::with('user')->paginate(10);

        return $galleries;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postGalleries(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255|string',
            'description' => 'max:1000',
            'urls' => 'required|array',
        ]);

        $user = User::find(Auth::user()->id);

        $gallery = new Gallery();

        $gallery->name = $request->name;
        $gallery->description = $request->description;
        $gallery->urls = implode(',', $request->urls);
        $gallery->user()->associate($user);

        $gallery->save();

        return $gallery;
    }

    /**
     * Display the specified resource.
     */
    public function showGallery(string $id)
    {
        $gallery = Gallery::with('user')->find($id);
        $gallery = Gallery::with('user', 'comments')->find($id);

        return $gallery;
    }

    /**
     * Update the specified resource in storage.
     */
    public function editGallery(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:2|max:255|string',
            'description' => 'max:1000',
            'urls' => 'required|array',
        ]);

        $gallery = Gallery::find($id);

        $gallery->name = $request->name;
        $gallery->description = $request->description;
        $gallery->urls = implode(',', $request->urls);
        $gallery->save();

        return $gallery;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteGallery(string $id)
    {
        Gallery::destroy($id);
    }
};