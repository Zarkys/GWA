<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesProductsTable extends Migration
{

    public function up()
    {
        Schema::create('prod_attributes_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->integer('show_attr')->default(0);
            $table->integer('id_product')->unsigned()->nullable();
            $table->integer('id_user')->unsigned();

            $table->foreign('id_product')->references('id')->on('prod_products')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prod_attributes_products');
    }
}
