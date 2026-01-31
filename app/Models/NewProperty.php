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
}
