<?php

namespace App\Http\Controllers;

use App\Service\GalleriesService;
use Illuminate\Http\Request;

class GalleriesController extends Controller
{

    public GalleriesService $galleriesService;

    public function __construct(GalleriesService $galleriesService)
    {
        $this->galleriesService = $galleriesService;

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $galleries = $this->galleriesService->showGalleries($request);

        return $galleries;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $gallery = $this->galleriesService->postGalleries($request);

        return $gallery;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gallery = $this->galleriesService->showGallery($id);

        return $gallery;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gallery = $this->galleriesService->editGallery($request, $id);
        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);

        return $gallery;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = $this->galleriesService->deleteGallery($id);

        return $gallery;
    }

    protected $fillable = [
        'name',
        'description',
        'urls',
        'user_id'
    ];
}