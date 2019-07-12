<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextsTable extends Migration
{

    public function up()
    {
         Schema::create('texts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128)->unique();
            $table->string('value_es', 128)->unique()->nullable();
            $table->string('value_en', 128)->unique()->nullable();
            $table->integer('id_section')->unsigned();
            $table->integer('active')->default(\Modules\Website\Models\Enums\ActiveText::$activated);
            $table->timestamps();

            $table->foreign('id_section')->references('id')->on('sections')->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('texts');
    }
}
