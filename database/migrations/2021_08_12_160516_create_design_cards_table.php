<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("customer_id")->nullable();
            $table->string("label")->nullable();
            $table->string("date")->nullable();
            $table->string('front_image')->nullable();
            $table->string('back_image')->nullable();
            $table->string('all_view_image')->nullable();
            $table->text('design_file')->nullable();
            $table->unsignedBigInteger("designer_id")->nullable();
            $table->unsignedBigInteger("salesrep_id")->nullable();
            $table->text("weaver")->nullable();
            $table->unsignedBigInteger("warps_id")->nullable();
            $table->string("finishing")->nullable();
            $table->text("description")->nullable();
            $table->longText("main_label")->nullable();
            $table->longText("tab_label")->nullable();
            $table->longText("size_label")->nullable();
            $table->text("add_on_main_cost")->nullable();
            $table->text("add_on_tab_cost")->nullable();
            $table->text("add_on_size_cost")->nullable();
            $table->longText("main_needle")->nullable();
            $table->longText("tab_needle")->nullable();
            $table->longText("size_needle")->nullable();
            $table->string("speed_effiency")->nullable();
            $table->string("customer_grade")->nullable();
            $table->string("category")->nullable();
            $table->string("chart")->nullable();
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
        Schema::dropIfExists('design_cards');
    }
}
