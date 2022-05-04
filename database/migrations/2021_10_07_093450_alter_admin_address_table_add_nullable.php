<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAdminAddressTableAddNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_addresses', function (Blueprint $table) {
            $table->string("flatno")->nullable()->change();
            $table->string("apartment")->nullable()->change();
            $table->string("landmark")->nullable()->change();
            $table->string("area")->nullable()->change();
            $table->string("zipcode")->nullable()->change();
            $table->string("city")->nullable()->change();
            $table->string("country")->nullable()->change();
            $table->string("state")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_addresses', function (Blueprint $table) {
            $table->string("flatno")->change();
            $table->string("apartment")->change();
            $table->string("landmark")->change();
            $table->string("area")->change();
            $table->string("zipcode")->change();
            $table->string("city")->change();
            $table->string("country")->change();
            $table->string("state")->change();
        });
    }
}
