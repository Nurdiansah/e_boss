<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function stevedoring()
    {
        return $this->hasMany(Stevedoring::class);
    }
}
