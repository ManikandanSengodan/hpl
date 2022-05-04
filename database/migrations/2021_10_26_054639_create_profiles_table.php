<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string("company_name");
            $table->string("mobile_no");
            $table->string("email");
            $table->string("GSTIN");
            $table->string("image");
            $table->string("type");
            $table->text("address");
            $table->string("account_name");
            $table->string("account_no");
            $table->string("IFSCCode");
            $table->string("bank_and_branch_name");
            $table->string("UPI_ID");
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
        Schema::dropIfExists('profiles');
    }
}
