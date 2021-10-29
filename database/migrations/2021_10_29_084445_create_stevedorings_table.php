<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStevedoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stevedorings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vessel_id');
            $table->bigInteger('agent_id');
            $table->bigInteger('itemmaster_id');
            $table->bigInteger('client_id');
            $table->bigInteger('stevedoringcategory_id');
            // jetty
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
        Schema::dropIfExists('stevedorings');
    }
}
