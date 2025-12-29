<?php

namespace App\Http\Controllers;

use App\Models\HomeModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propertyTypes = ['All Residential', 'All Commercial'];
        $age = 30;
        $location = 'New York';

        return view('frontend.home', [
            'propertyTypes' => $propertyTypes,
            'age' => $age,
            'location' => $location
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeModel $homeModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeModel $homeModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeModel $homeModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeModel $homeModel)
    {
        //
    }
}
