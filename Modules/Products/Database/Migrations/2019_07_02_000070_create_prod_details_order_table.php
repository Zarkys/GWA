<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdDetailsOrderTable extends Migration
{

    public function up()
    {

        Schema::create('prod_details_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_order')->unsigned();
            $table->integer('id_product')->unsigned();
            $table->float('amount', 18, 2)->nullable();
            $table->integer('status')->default(\Modules\Products\Models\Enums\StatusDetailsOrder::$pending);

            $table->foreign('id_order')->references('id')->on('prod_orders')->onDelete('cascade');
            $table->foreign('id_product')->references('id')->on('prod_products')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('prod_details_order');
    }
}
