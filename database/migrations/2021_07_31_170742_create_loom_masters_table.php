<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoomMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loom_masters', function (Blueprint $table) {
            $table->id();
            $table->string("loom_name");
            $table->string("weaving_width_Meter");
            $table->string("sections");
            $table->string("year");
            $table->string("speed");
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
        Schema::dropIfExists('loom_masters');
    }
}
