<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recor_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('type');
            $table->string('url');
            $table->string('size')->nullable();
            $table->string('dimension')->nullable();
            $table->string('legend')->nullable();
            $table->integer('id_user')->unsigned();
            $table->integer('active')->default(\Modules\Records\Models\Enums\ActiveArchive::$activated);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
        });
    }
    
        // 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('records');
    }
}
