<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertySubType extends Model
{
    protected $fillable = ['property_type_id', 'name'];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}
