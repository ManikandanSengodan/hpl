<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintedFoldMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printed_fold_masters', function (Blueprint $table) {
            $table->id();
            $table->string("type_of_fold");
            $table->string("image");
            $table->string("minimum_mm");
            $table->string("maximum_mm");
            $table->string("notes");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printed_fold_masters');
    }
}
