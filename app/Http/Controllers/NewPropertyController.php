<?php

namespace App\Http\Controllers;

use App\Models\NewProperty;
use Illuminate\Http\Request;

class NewPropertyController extends Controller
{
    public function listing(){
        return NewProperty::with([
            'assets' => function ($q) {
                $q->active()->where('type', 'thumbnail');
            }
        ])->active()->get();
    }

    public function detail(Request $request){
        return NewProperty::with([
            'assets' => function ($q) {
                $q->active()->orderBy('sort_order');
            }
        ])->find($id);

    }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NewProperty $newProperty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewProperty $newProperty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NewProperty $newProperty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewProperty $newProperty)
    {
        //
    }
}
