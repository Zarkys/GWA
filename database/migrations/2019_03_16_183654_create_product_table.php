<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->integer('id_type_product')->unsigned();
            $table->string('image')->unique()->nullable();
            $table->float('price', 15, 2)->nullable();
            $table->float('price_discount', 15, 2)->nullable();
            $table->integer('show_price');
            $table->integer('id_category_for_product')->unsigned();
            
            $table->integer('active');
            $table->timestamps();

            $table->foreign('id_type_product')->references('id')->on('types_products')->onDelete('cascade');
            $table->foreign('id_category_for_product')->references('id')->on('categories_for_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
