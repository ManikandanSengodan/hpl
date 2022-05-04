<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishingMachineMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finishing_machine_masters', function (Blueprint $table) {
            $table->id();
            $table->string("machine");
            $table->string("folds_available");
            $table->string("min_end_fold");
            $table->string("max_length_mm");
            $table->string("speed");
            $table->string("year");
            $table->string("notes");
            $table->string("serial_Nos");
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
        Schema::dropIfExists('finishing_machine_masters');
    }
}
