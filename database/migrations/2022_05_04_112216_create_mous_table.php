<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMousTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mous', function (Blueprint $table) {
            $table->id();
            $table->string("ship_to_party_code")->nullable();
            $table->unsignedBigInteger("customer_id")->nullable();
            $table->string("group_company")->nullable();
            $table->unsignedBigInteger("price_point")->nullable();
            $table->string("major_points")->nullable();
            $table->string("css_period")->nullable();
            $table->string("mou_type")->nullable();
            $table->unsignedBigInteger("monthly_target")->nullable();
            $table->unsignedBigInteger("quarterly_target")->nullable();
            $table->unsignedBigInteger("annual_target")->nullable();
            $table->float("monthly_rate")->nullable();
            $table->float("quarterly_rate")->nullable();
            $table->float("annual_rate")->nullable();
            $table->text("adderss");
            $table->string("region")->nullable();
            $table->dateTime("from_date")->nullable();
            $table->dateTime("to_date")->nullable();
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
        Schema::dropIfExists('mous');
    }
}
