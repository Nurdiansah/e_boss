<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_masters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('area_id');
            $table->string('name');
            $table->decimal('long', $precision = 6, $scale = 2);
            $table->decimal('widht', $precision = 6, $scale = 2);
            $table->decimal('height', $precision = 6, $scale = 2);
            $table->string('unit');
            $table->decimal('volume', $precision = 6, $scale = 2);
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
        Schema::dropIfExists('item_masters');
    }
}
