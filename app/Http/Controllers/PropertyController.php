<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::latest()->get();
        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'flat' => 'required|string|max:500',
            'floor' => 'required|string|max:100',
            'plot' => 'required|string|max:100',
            'bldg_no' => 'required|string|max:200',
            'bldg_name' => 'required|string|max:200',
            'sector_no' => 'required|string|max:200',
            'area' => 'required|string|max:200',
            'city' => 'required|string|max:200',
            'zip' => 'required|string|max:10',
            'amount' => 'required',
            'category' => 'required|in:buy,rent',
            'property_type_id' => 'required|integer',
            'property_sub_type_id' => 'required|integer',
            'showtohome' => 'required|in:1,2',
        ]);

        Property::create($request->all());

        return redirect()->route('properties.index')
            ->with('success', 'Property added successfully');
    }

    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $request->validate([
            'flat' => 'required|string|max:500',
            'floor' => 'required|string|max:100',
            'plot' => 'required|string|max:100',
            'bldg_no' => 'required|string|max:200',
            'bldg_name' => 'required|string|max:200',
            'sector_no' => 'required|string|max:200',
            'area' => 'required|string|max:200',
            'city' => 'required|string|max:200',
            'zip' => 'required|string|max:10',
            'amount' => 'required',
            'category' => 'required|in:buy,rent',
            'property_type_id' => 'required|integer',
            'property_sub_type_id' => 'required|integer',
            'showtohome' => 'required|in:1,2',
        ]);

        $property->update($request->all());

        return redirect()->route('properties.index')
            ->with('success', 'Property updated successfully');
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('properties.index')
            ->with('success', 'Property deleted successfully');
    }

    public function listing(){
        return Property::with([
            'assets' => function ($q) {
                $q->active()->where('type', 'thumbnail');
            }
        ])->active()->get();
    }

    public function detail(Request $request){
        return Property::with([
            'assets' => function ($q) {
                $q->active()->orderBy('sort_order');
            }
        ])->find($id);

    }
}
