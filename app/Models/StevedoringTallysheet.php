<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StevedoringTallysheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'stevedoring_id',
        'stevedoringmanifest_id',
        'itemmaster_id',
        'description',
        'doc_no',
        'qty',
        'm3',
        'ton',
        'revton',
        'remarks',
        'row_version',
        'time',
        'origin_destination'
    ];
}
