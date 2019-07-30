<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesProductsTable extends Migration
{

    public function up()
    {
        Schema::create('categories_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->string('slug', 128)->unique();
            $table->text('description')->nullable();
            $table->integer('id_user')->unsigned();
            $table->integer('active')->default(1);

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('categories_products');
    }
}
