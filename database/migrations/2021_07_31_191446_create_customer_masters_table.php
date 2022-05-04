<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_masters', function (Blueprint $table) {
            $table->id();
            $table->string("company_name");
            $table->string("company_phone");
            $table->string("full_name");
            $table->integer("category")->nullable();
            $table->string("mobile_number");
            $table->string("email")->unique();
            $table->text("secondary_email")->nullable();
            $table->unsignedBigInteger("sales_rep");
            $table->foreign("sales_rep")->references("id")->on("staf_masters");
            $table->timestamp("email_verified_at")->nullable();
            $table->string("password");
            $table->integer('status');
            $table->string("bank_name");
            $table->string("account_no");
            $table->string("IFSCCode");
            $table->string("opening_balance");
            $table->string("credit_balance");
            $table->string("credit_period");
            $table->text("billing_address");
            $table->text("shipping_address");
            $table->string("grade");
            $table->string("GST");
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
        Schema::dropIfExists('customer_masters');
    }
}
