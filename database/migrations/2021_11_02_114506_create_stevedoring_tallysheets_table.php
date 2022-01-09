<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStevedoringTallysheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stevedoring_tallysheets', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('stevedoring_id');
            $table->integer('stevedoringmanifest_id');
            $table->smallInteger('itemmaster_id');
            $table->string('description', 50);
            $table->string('doc_no', 10);
            $table->smallInteger('qty');
            $table->decimal('m3', $precision = 6, $scale = 2);
            $table->decimal('ton', $precision = 6, $scale = 2);
            $table->decimal('revton', $precision = 6, $scale = 2)->nullable();
            $table->string('remarks', 200);
            $table->string('row_version', 10)->default('1');
            $table->dateTime('time');
            $table->string('origin_destination')->nullable();
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
        Schema::dropIfExists('stevedoring_tallysheets');
    }
}
