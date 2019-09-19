<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesProductsTable extends Migration
{

    public function up()
    {
        Schema::create('prod_currencies_products', function (Blueprint $table) {
            $table->char('iso', 3);
            $table->string('name', 30);
            $table->string('symbol', 15);
            $table->char('thousand_separator', 1);
            $table->char('decimal_separator', 1);
            $table->integer('decimals');
            $table->primary('iso');

            $table->integer('active')->default(0);

        });
    }

    public function down()
    {
        Schema::dropIfExists('prod_currencies_products');
    }
}
