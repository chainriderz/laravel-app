<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewProperty extends Model
{
    use HasFactory;

    protected $table = 'new_properties';

    protected $fillable = [
        'project_name',
        'property_type_id',
        'city_id',
        'area_id',
        'landmark_id',
        'builder_name',
        'rera_number',
        'launch_date',
        'possession_date',
        'status',
        'showtohome',
        'is_active',
    ];

    // Relations
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function assets()
    {
        return $this->morphMany(
            Asset::class,
            'assets',
            'table_name',
            'table_id'
        );
    }

    public function thumbnail()
    {
        return $this->assets()
                    ->where('type', 'thumbnail')
                    ->where('is_active', true)
                    ->first();
    }

    public function images()
    {
        return $this->assets()
                    ->where('type', 'image')
                    ->where('is_active', true)
                    ->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query
                    ->where('is_active', true)
                    ->where(function ($q) {
                    $q->whereNull('active_till')
                        ->orWhere('active_till', '>=', now());
                    });
    }

    public function scopeHomeVisible($query)
    {
        return $query->active()
                     ->where('showtohome', '1')
                     ->with([
                        'city:id,name',
                        'area:id,name',
                        'assets' => function ($q) {
                            $q->where('is_active', true)
                              ->orderBy('sort_order');
                        },
                    ]);
    }
}
