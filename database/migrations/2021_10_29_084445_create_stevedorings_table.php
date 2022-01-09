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
            $table->integerIncrements('id');
            $table->string('code', 6)->nullable();
            $table->tinyInteger('area_id');
            $table->smallInteger('client_id');
            $table->smallInteger('vessel_id');
            $table->smallInteger('agent_id');
            $table->tinyInteger('jetty_id');
            $table->tinyInteger('stevedoringcategory_id');
            $table->smallInteger('checker_id')->nullable();
            $table->dateTime('entry_date');
            $table->dateTime('exit_date')->nullable();
            $table->string('orign_port', 50);
            $table->string('destination_port', 50);
            $table->string('command_document');
            $table->string('wo_number', 100);
            $table->decimal('plan_amount', $precision = 6, $scale = 2)->nullable();
            $table->decimal('final_amount', $precision = 6, $scale = 2)->nullable();
            $table->string('doc_ptw', 200);
            $table->string('doc_pjsm', 200);
            $table->string('doc_lsap', 200);
            $table->dateTime('start_activity')->nullable();
            $table->dateTime('finish_activity')->nullable();
            $table->bigInteger('number_duration')->nullable();
            $table->string('text_duration', 200)->nullable();
            $table->text('komentar')->nullable();
            $table->string('status', 2)->default('0');
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
