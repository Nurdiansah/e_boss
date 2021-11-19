<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StevedoringCategory extends Model
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
