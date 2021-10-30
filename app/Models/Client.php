<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    public function stevedoring()
    {
        return $this->hasMany(Stevedoring::class);
    }
}
