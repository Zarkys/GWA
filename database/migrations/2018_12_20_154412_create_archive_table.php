<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('type');
            $table->datetime('creation_date');
            $table->string('size');
            $table->string('dimension');
            $table->string('url');
            $table->string('title')->nullable();
            $table->string('legend');
            $table->string('alternative_text')->nullable();
            $table->string('description')->nullable();
            $table->integer('id_user')->unsigned();
            $table->integer('active');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
        // 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('archives');
    }
}
