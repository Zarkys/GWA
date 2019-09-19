<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{

    public function up()
    {

        Schema::create('prod_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->float('price', 18, 2)->nullable();
            $table->float('price_discount', 18, 2)->nullable();

            $table->integer('show_price')->default(0);
            $table->integer('active')->default(1);
            $table->integer('id_type')->unsigned();
            $table->integer('id_category')->unsigned();
            $table->char('currency',3);
            $table->timestamps();

            $table->foreign('id_type')->references('id')->on('prod_types_products')->onDelete('cascade');
            $table->foreign('id_category')->references('id')->on('prod_categories_products')->onDelete('cascade');
            $table->foreign('currency')->references('iso')->on('prod_currencies_products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('prod_products');
    }
}
