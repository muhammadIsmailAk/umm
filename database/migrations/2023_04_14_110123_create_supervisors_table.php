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
        Schema::create('supervisors', function (Blueprint $table) {
            
                $table->id();
                $table->bigInteger('supervisor_id')->index()->unsigned();
                $table->foreign('supervisor_id')->references('id')->on('users');
            
                $table->string('name');
                $table->string('email')->unique();
                $table->string('depart_name');
               
                $table->string('status');
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
        Schema::dropIfExists('supervisors');
    }
};
