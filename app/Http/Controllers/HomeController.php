<?php

namespace App\Http\Controllers;

use App\Models\HomeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Property;
use App\Models\Area;
use App\Models\City;
use App\Models\PropertyType;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propertyTypes = PropertyType::where('is_active', true)->orderBy('name')->get();
        $rentalProp = Property::activeRent()->get();
        $saleProp = Property::activeBuy()->get();

        $age = 30;

        return view('frontend.home', [
            'propertyTypes' => $propertyTypes,
            'rentalProp'    => $rentalProp,
            'saleProp'      => $saleProp,
        ]);
    }

    public function search(Request $request)
    {
        $response = collect([
            'status'   => false,
            'message'  => null,
            'response' => null,
        ]);

        // Normalize request
        $request->merge([
            'property_type' => $request->property_type ?: null
        ]);

        // ✅ Validator
        $validator = Validator::make($request->all(), [
            'q'             => 'required|string|min:2|max:100',
            'property_type' => 'nullable|integer|exists:property_types,id',
            'category'      => 'required|in:buy,rent'
        ]);

        // ❌ If validation fails
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json($response, 422);
        }

        $query = trim($request->q);
        $propertyTypeId = $request->property_type;
        $category = $request->category;
        $results = collect();

        /*
        |--------------------------------------------------------------------------
        | 1. Cities (Highest priority)
        |--------------------------------------------------------------------------
        */
        City::where('name', 'LIKE', "%{$query}%")->where('is_active', true)
            ->orderBy('name')
            ->limit(5)
            ->get()
            ->each(function ($city) use ($results) {
                $results->push([
                    'id'   => "city_{$city->id}",
                    'text' => "Locality: {$city->name}",
                    'type' => 'City',
                ]);
            });

        /*
        |--------------------------------------------------------------------------
        | 2. Areas / Localities
        |--------------------------------------------------------------------------
        */
        Area::where('name', 'LIKE', "%{$query}%")->where('is_active', true)
            ->orderBy('name')
            ->limit(5)
            ->get()
            ->each(function ($area) use ($results) {
                $results->push([
                    'id'   => "area_{$area->id}",
                    'text' => "Locality: {$area->name}",
                    'type' => 'Locality',
                ]);
            });

        /*
        |--------------------------------------------------------------------------
        | 3. Projects / Buildings (Grouped)
        |--------------------------------------------------------------------------
        */
        
        Property::select(
                DB::raw('MIN(id) as id'),
                'bldg_name',
                'area_id',
                'city_id'
            )
            ->with(['area:id,name', 'city:id,name']) // 👈 eager loading
            ->when($propertyTypeId, function ($q) use ($propertyTypeId) {
                $q->where('property_type_id', $propertyTypeId);
            })
            ->where('category', $category)
            ->where('bldg_name', 'LIKE', "%{$query}%")
            ->where('is_active', true)
            ->where('active_till', '>=', now()->toDateString())
            ->groupBy('bldg_name', 'area_id', 'city_id')
            ->orderBy('bldg_name')
            ->limit(5)
            ->get()
            ->each(function ($property) use ($results) {
                $results->push([
                    'id'   => "property_{$property->id}",
                    'text' => "Property: {$property->bldg_name}, {$property->area->name}, {$property->city->name}",
                    'type' => 'Project',
                ]);
            });
        

        /*
        |--------------------------------------------------------------------------
        | 4. Landmarks (Lowest priority)
        |--------------------------------------------------------------------------
        */
        Property::select(
                DB::raw('MIN(id) as id'), 
                'landmark',
                'area_id',
                'city_id'
            )
            ->whereNotNull('landmark')
            ->with(['area:id,name', 'city:id,name']) // 👈 eager loading
            ->when($propertyTypeId, function ($q) use ($propertyTypeId) {
                $q->where('property_type_id', $propertyTypeId);
            })
            ->where('category', $category)
            ->where('landmark', 'LIKE', "%{$query}%")
            ->where('is_active', true)
            ->where('active_till', '>=', now()->toDateString())
            ->groupBy('landmark', 'area_id', 'city_id')
            ->orderBy('landmark')
            ->limit(5)
            ->get()
            ->each(function ($row) use ($results) {
                $results->push([
                    'id'   => "landmark_{$row->id}",
                    'text' => "Landmark: $row->landmark, {$row->area->name}, {$row->city->name}",
                    'type' => 'Landmark',
                ]);
            });

        $response['status'] = true;
        $response['response'] = $results;

        return response()->json($response);
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
