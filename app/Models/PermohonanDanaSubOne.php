<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanDanaSubOne extends Model
{
    use HasFactory;


    protected $fillable = [
        'permohonandana_id',
        'dasar_harga',
        'deskripsi',
        'ppn',
        'pph',
        'pengajuan',
        'kd_transaksi',
        'status'
    ];

    public function permohonandana()
    {
        return $this->belongsTo(PermohonanDana::class);
    }
}
