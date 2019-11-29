<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doct_doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('consulting_room')->nullable();
            $table->string('phone')->nullable();
            $table->integer('id_specialty')->unsigned();
            $table->integer('active');
            $table->timestamps();

            $table->foreign('id_specialty')->references('id')->on('doct_specialties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doct_doctors');
    }
}
