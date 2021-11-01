<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StevedoringTimeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'stevedoring_id',
        'time_stop',
        'time_start_again',
        'description',
    ];
}
