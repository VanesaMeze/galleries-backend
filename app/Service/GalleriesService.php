<?php

namespace App\Service;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleriesService {
    /**
     * Display a listing of the resource.
     */
    public function showGalleries()
    {
        $galleries = Gallery::paginate(10);

        return $galleries;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postGalleries(Request $request)
    {
        $gallery = new Gallery();
        $gallery->name = $request->name;
        $gallery->description = $request->description;
        $gallery->urls = $request->urls;
        $gallery->author_id = $request->author_id;
        $gallery->save();

        return $gallery;
    }

    /**
     * Display the specified resource.
     */
    public function showGallery(string $id)
    {
        $gallery = Gallery::with('comments')->find($id);

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
            'urls' => 'required',
        ]);

        $gallery = Gallery::find($id);

        $gallery->name = $request->name;
        $gallery->description = $request->description;
        $gallery->urls = $request->urls;
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
}