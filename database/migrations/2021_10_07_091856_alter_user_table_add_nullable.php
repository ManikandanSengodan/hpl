<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserTableAddNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('status')->nullable()->change();
            $table->string("qualification")->nullable()->change();
            $table->string("blood_group")->nullable()->change();
            $table->string("joined_on")->nullable()->change();
            $table->string("left_on")->nullable()->change();
            $table->unsignedBigInteger("role_id")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('status')->change();
            $table->string("qualification")->change();
            $table->string("blood_group")->change();
            $table->string("joined_on")->change();
            $table->string("left_on")->change();
            $table->unsignedBigInteger("role_id")->change();
        });
    }
}
