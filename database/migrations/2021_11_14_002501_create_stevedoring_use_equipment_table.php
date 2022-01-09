<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStevedoringUseEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stevedoring_use_equipment', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('stevedoring_id');
            $table->smallInteger('equipment_id');
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
        Schema::dropIfExists('stevedoring_use_equipment');
    }
}
