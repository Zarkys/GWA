<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Page extends Migration
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
            $table->string('title');
            $table->longText('content');
            $table->integer('id_featured_image')->unsigned();
            $table->string('visibility');
            $table->integer('status_page');
            $table->integer('id_user');
            $table->string('permanent_link');
            $table->datetime('creation_date');
            $table->datetime('publication_date');
            $table->datetime('modification_date');
            $table->integer('active');
            $table->timestamps();

             $table->foreign('id_featured_image')->references('id')->on('archives')->onDelete('cascade');
        // $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
