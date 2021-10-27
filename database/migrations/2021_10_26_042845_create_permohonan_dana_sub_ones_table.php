<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanDanaSubOnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_dana_sub_ones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('permohonandana_id');
            $table->decimal('dasar_harga', $precision = 13, $scale = 2);
            $table->decimal('ppn', $precision = 13, $scale = 2);
            $table->decimal('pph', $precision = 13, $scale = 2);
            $table->decimal('pengajuan', $precision = 13, $scale = 2);
            $table->string('kd_transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permohonan_dana_sub_ones');
    }
}
