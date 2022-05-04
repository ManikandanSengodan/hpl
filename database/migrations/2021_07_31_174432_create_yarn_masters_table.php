<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYarnMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yarn_masters', function (Blueprint $table) {
            $table->id();
            $table->string("supplier");
            $table->string("yarn_denier");
            $table->string("shade_No");
            $table->string("shade_No_suffix");
            $table->string("yarn_color");
            $table->string("color_shade");
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
        Schema::dropIfExists('yarn_masters');
    }
}
