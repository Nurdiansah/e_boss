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
}
