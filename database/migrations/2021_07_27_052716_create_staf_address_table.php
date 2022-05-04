<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStafAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staf_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("staf_id");
            $table->string("fullname");
            $table->string("flatno");
            $table->string("apartment");
            $table->string("landmark");
            $table->string("area");
            $table->string("zipcode");
            $table->string("city");
            $table->string("country");
            $table->string("state");
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
        Schema::dropIfExists('staf_address');
    }
}
