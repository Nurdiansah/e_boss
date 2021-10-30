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
            $table->id();
            $table->bigInteger('stevedoring_id');
            $table->bigInteger('itemmaster_id');
            $table->string('description');
            $table->string('doc_no');
            $table->intiger('qty');
            $table->decimal('m3', $precision = 6, $scale = 2);
            $table->decimal('ton', $precision = 6, $scale = 2);
            $table->decimal('revton', $precision = 6, $scale = 2)->nullable();
            $table->string('remarks');
            $table->string('status')->default('1');
            $table->string('cargo_final')->default('0');
            $table->string('row_version')->default('1');
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
