<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_area',
        'name',
    ];

    public function stevedoring()
    {
        return $this->hasMany(Stevedoring::class);
    }
}
