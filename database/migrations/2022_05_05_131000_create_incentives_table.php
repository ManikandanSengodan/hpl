<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncentivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incentives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("customer_id")->nullable();
            $table->unsignedBigInteger("mou_id")->nullable();
            $table->text("jul");
            $table->text("aug");
            $table->text("sep");
            $table->text("oct");
            $table->text("nov");
            $table->text("dec");
            $table->text("jan");
            $table->text("feb");
            $table->text("mar");
            $table->text("q2");
            $table->text("q3");
            $table->text("q4");
            $table->text("annual");
            $table->integer("publish");

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
        Schema::dropIfExists('incentives');
    }
}
