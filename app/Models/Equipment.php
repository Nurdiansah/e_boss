<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipmentcategory_id',
        'area_id',
        'name',
        'capacity',
        'status',
    ];

    public function stevedoringuseequipment()
    {
        return $this->hasMany(StevedoringUseEquipment::class);
    }
}
