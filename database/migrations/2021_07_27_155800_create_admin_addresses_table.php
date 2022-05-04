<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("admin_id");
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
            $table
            ->foreign("admin_id")
            ->references("id")
            ->on("users");
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_addresses');
    }
}
