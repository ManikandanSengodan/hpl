<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_masters', function (Blueprint $table) {
            $table->id();
            $table->string("full_name");
            $table->integer("category")->nullable();
            $table->string("mobile_number");
            $table->string("email")->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("password");
            $table->string("bank_name");
            $table->string("account_no");
            $table->integer('status');
            $table->string("IFSCCode");
            $table->string("opening_balance");
            $table->string("credit_balance");
            $table->string("credit_period");
            $table->string("grade");
            $table->text("billing_address");
            $table->text("shipping_address");
            $table->string("CGST");
            $table->string("SGST");
            $table->string("IGST");
            $table->rememberToken();
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
        Schema::dropIfExists('vendor_masters');
    }
}
