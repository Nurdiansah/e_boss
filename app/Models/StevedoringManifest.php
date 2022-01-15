<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StevedoringManifest extends Model
{
    use HasFactory;

    protected $fillable = [
        'stevedoring_id',
        'itemmaster_id',
        'description',
        'doc_no',
        'qty',
        'm3',
        'ton',
        'revton',
        'remarks',
        'status',
        'cargo_final',
        'row_version',
    ];

    // FK relasi ke table 
    public function itemmaster()
    {
        return $this->belongsTo(ItemMaster::class);
    }
}
