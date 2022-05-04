<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string("design_id");
            $table->string("party_po_no")->nullable();
            $table->string("sale_order_no")->nullable();
            $table->string("our_design_no")->nullable();
            $table->string("lable")->nullable();
            $table->string("meterial")->nullable();
            $table->string("met_width")->nullable();
            $table->string("met_length")->nullable();
            $table->string("qty")->nullable();
            $table->string("folding")->nullable();
            $table->string("fold_width")->nullable();
            $table->string("fold_lenth")->nullable();
            $table->string("total")->nullable();
            $table->string("balance")->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
}
