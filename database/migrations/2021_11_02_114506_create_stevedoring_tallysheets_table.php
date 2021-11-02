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
            $table->id();
            $table->bigInteger('stevedoring_id');
            $table->bigInteger('stevedoringmanifest_id');
            $table->bigInteger('itemmaster_id');
            $table->string('description');
            $table->string('doc_no');
            $table->integer('qty');
            $table->decimal('m3', $precision = 6, $scale = 2);
            $table->decimal('ton', $precision = 6, $scale = 2);
            $table->decimal('revton', $precision = 6, $scale = 2)->nullable();
            $table->string('remarks');
            $table->string('row_version')->default('1');
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
