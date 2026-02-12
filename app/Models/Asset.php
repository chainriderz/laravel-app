<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    //use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'table_name',
        'table_id',
        'type',
        'file_path',
        'original_name',
        'sort_order',
        'is_active',
    ];

    public function assetable()
    {
        return $this->morphTo();
    }

    /* ---------- SCOPES ---------- */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeImages($query)
    {
        return $query->where('type', 'image');
    }

    public function scopeThumbnail($query)
    {
        return $query->where('type', 'thumbnail');
    }
}
