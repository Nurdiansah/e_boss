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
            $table->string('code');
            $table->bigInteger('area_id');
            $table->bigInteger('client_id');
            $table->bigInteger('vessel_id');
            $table->bigInteger('agent_id');
            $table->bigInteger('jetty_id');
            $table->bigInteger('stevedoringcategory_id');
            $table->bigInteger('checker_id');
            $table->dateTime('entry_date');
            $table->dateTime('exit_date')->nullable();
            $table->string('orign_port');
            $table->string('destination_port');
            $table->string('command_document');
            $table->string('wo_number');
            $table->decimal('plan_amount', $precision = 6, $scale = 2);
            $table->decimal('final_amount', $precision = 6, $scale = 2)->nullable();
            $table->string('doc_ptw');
            $table->string('doc_pjsm');
            $table->string('doc_lsap');
            $table->dateTime('start_activity')->nullable();
            $table->dateTime('finish_activity')->nullable();
            $table->bigInteger('number_duration');
            $table->string('text_duration');
            $table->text('komentar');
            $table->string('status')->default('0');
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
