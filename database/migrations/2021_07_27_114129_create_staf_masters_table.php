<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStafMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staf_masters', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email")->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("password");
            $table->string('phone');
            $table->integer('status');
            $table->string("qualification")->nullable();
            $table->string("blood_group")->nullable();
            $table->string("joined_on");
            $table->string("left_on")->nullable();
            $table->string("documentID")->nullable();
            $table->string("document_name")->nullable();
            $table->text("address")->nullable();
            $table->unsignedBigInteger("role_id");
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
        Schema::dropIfExists('staf_masters');
    }
}
