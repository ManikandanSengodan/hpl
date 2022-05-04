<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_masters', function (Blueprint $table) {
            $table->id();
            $table->string("fullname");
            $table->string("place");
            $table->string("account_number");
            $table->string("IFSC_code");
            $table->string("bank_code");
            $table->text("adderss");
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
        Schema::dropIfExists('bank_masters');
    }
}
