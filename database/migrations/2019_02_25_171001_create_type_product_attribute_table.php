<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeProductAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types_products_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_attribute')->unsigned();
            $table->integer('id_type_product')->unsigned();
            $table->integer('active');
            $table->timestamps();

            
            $table->foreign('id_attribute')->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('id_type_product')->references('id')->on('types_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types_products_attributes');
    }
}
