<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StevedoringUseEquipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'stevedoring_id',
        'equipment_id'
    ];

    // FK relasi ke table refrensi
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function stevedoring()
    {
        return $this->belongsTo(Stevedoring::class);
    }
}
