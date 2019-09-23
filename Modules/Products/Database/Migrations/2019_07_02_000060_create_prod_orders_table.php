<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('prod_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number_order')->nullable();
            $table->integer('id_user')->unsigned();
            $table->float('amount_total', 18, 2)->nullable();

            $table->integer('status')->default(\Modules\Products\Models\Enums\StatusOrders::$open);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prod_orders');
    }
}
