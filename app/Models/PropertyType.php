<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $fillable = ['name'];

    public function subTypes()
    {
        return $this->hasMany(PropertySubType::class);
    }
}
