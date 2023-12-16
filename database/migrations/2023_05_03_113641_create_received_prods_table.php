<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_prods', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('user_id')->index()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('product_id')->index()->unsigned();
            $table->foreign('product_id')->references('id')->on('items');
            $table->string('level');
            
            $table->date('acquire_date');
            $table->date('expire_date');
            $table->string('email')->unique();
            
           
            $table->string('status');
            $table->string('');

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
        Schema::dropIfExists('received_prods');
    }
};
