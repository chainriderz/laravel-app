<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $propertyId)
    {
        $request->validate([
            'type' => 'required|in:thumbnail,image,video,brochure',
            'file' => 'required|file|max:10240',
        ]);

        $property = Property::findOrFail($propertyId);

        $path = $request->file('file')->store('properties/'.$property->id, 'public');

        // If thumbnail → deactivate old one
        if ($request->type === 'thumbnail') {
            $property->assets()
                ->where('type', 'thumbnail')
                ->update(['is_active' => false]);
        }

        $property->assets()->create([
            'type'          => $request->type,
            'file_path'     => $path,
            'original_name' => $request->file('file')->getClientOriginalName(),
        ]);

        return back()->with('success', 'Asset uploaded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        //
    }
}
