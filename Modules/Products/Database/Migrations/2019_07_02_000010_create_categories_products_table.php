<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesProductsTable extends Migration
{

    public function up()
    {
        Schema::create('prod_categories_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->string('slug', 128)->unique();
            $table->text('description')->nullable();
            $table->integer('active')->default(1);

            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('prod_categories_products');
    }
}
