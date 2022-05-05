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
            $table->string("mou_code")->nullable();
            $table->string("ship_to_party_code")->nullable();
            $table->unsignedBigInteger("customer_id")->nullable();
            $table->string("group_company")->nullable();
            $table->string("price_point")->nullable();
            $table->string("major_grade")->nullable();
            $table->string("css_period")->nullable();
            $table->string("mou_type")->nullable();
            $table->unsignedBigInteger("monthly_target")->nullable();
            $table->unsignedBigInteger("quarterly_target")->nullable();
            $table->unsignedBigInteger("annual_target")->nullable();
            $table->unsignedBigInteger("monthly_rate")->nullable();
            $table->unsignedBigInteger("quarterly_rate")->nullable();
            $table->unsignedBigInteger("annual_rate")->nullable();
            $table->text("address");
            $table->string("region")->nullable();
            $table->date("from_date")->nullable();
            $table->date("to_date")->nullable();
            $table->integer('status')->nullable()->change();
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
        Schema::dropIfExists('mous');
    }
}
