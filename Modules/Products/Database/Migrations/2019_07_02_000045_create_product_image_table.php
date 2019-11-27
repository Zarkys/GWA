<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImageTable extends Migration
{

    public function up()
    {

        Schema::create('prod_product_image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_archive')->nullable();
            $table->integer('id_product')->unsigned();

            $table->foreign('id_product')->references('id')->on('prod_products')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('prod_product_image');
    }
}
