<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    protected $fillable = [
        'flat',
        'floor',
        'plot',
        'bldg_no',
        'bldg_name',
        'sector_no',
        'area_id',
        'city_id',
        'zip',
        'amount',
        'category',
        'property_type_id',
        'property_sub_type_id',
        'showtohome',
        'is_active',
    ];

    public function area() {
        return $this->belongsTo(Area::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    /**
     * Scope: fetch only active rental properties
     */
    public function scopeActiveRent($query)
    {
        return $query
                    ->where('is_active', true)
                    ->where('category', 'rent')
                    ->where(function ($q) {
                    $q->whereNull('active_till')
                        ->orWhere('active_till', '>=', now());
                    });
    }

    /**
     * Scope: fetch only active sell properties
     */
    public function scopeActiveBuy($query)
    {
        return $query
                    ->where('is_active', true)
                    ->where('category', 'buy')
                    ->where(function ($q) {
                    $q->whereNull('active_till')
                        ->orWhere('active_till', '>=', now());
                    });
    }
}
