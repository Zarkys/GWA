<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitewImagesTable extends Migration
{

    public function up()
    {
        Schema::create('sitew_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->integer('id_section')->unsigned();
            $table->integer('active')->default(\Modules\Website\Models\Enums\ActiveImage::$activated);
            $table->foreign('id_section')->references('id')->on('sitew_sections')->onDelete('cascade');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('sitew_images');
    }
}
