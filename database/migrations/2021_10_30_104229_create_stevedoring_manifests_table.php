<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStevedoringManifestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stevedoring_manifests', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('stevedoring_id');
            $table->integer('itemmaster_id');
            $table->string('description', 50);
            $table->string('doc_no', 20);
            $table->smallInteger('qty');
            $table->decimal('m3', $precision = 6, $scale = 2);
            $table->decimal('ton', $precision = 6, $scale = 2);
            $table->decimal('revton', $precision = 6, $scale = 2)->nullable();
            $table->string('remarks');
            $table->string('status', 3)->default('1');
            $table->string('cargo_final', 3)->default('0');
            $table->string('row_version', 3)->default('1');
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
        Schema::dropIfExists('stevedoring_manifests');
    }
}
