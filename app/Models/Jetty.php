<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jetty extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'name'
    ];

    public function stevedoring()
    {
        return $this->hasMany(Stevedoring::class);
    }
}
