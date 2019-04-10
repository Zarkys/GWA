<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('visibility');
            $table->integer('status_page');
            $table->integer('id_user')->unsigned();
            $table->string('permanent_link')->unique();
            $table->datetime('creation_date');
            $table->datetime('publication_date')->nullable();
            $table->datetime('modification_date')->nullable();
            $table->integer('active');
            $table->timestamps();

           // $table->foreign('id_featured_image')->references('id')->on('archives')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
        
    }
        
        
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
