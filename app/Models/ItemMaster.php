<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'name',
        'long',
        'widht',
        'height',
        'unit',
        'volume'
    ];

    // PK relasi ke table lain
    public function stevedoringmanifest()
    {
        return $this->hasMany(StevedoringManifest::class);
    }

    public function stevedoringtallysheet()
    {
        return $this->hasMany(StevedoringTallysheet::class);
    }
}
