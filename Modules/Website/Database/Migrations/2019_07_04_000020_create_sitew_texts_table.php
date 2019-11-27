<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitewTextsTable extends Migration
{

    public function up()
    {
         Schema::create('sitew_texts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128)->unique();
            $table->longText('value_es')->nullable();
            $table->longText('value_en')->nullable();
            $table->integer('id_section')->unsigned();
            $table->integer('active')->default(\Modules\Website\Models\Enums\ActiveText::$activated);
            $table->foreign('id_section')->references('id')->on('sitew_sections')->onDelete('cascade');
            $table->timestamps();
         });

    }

    public function down()
    {
        Schema::dropIfExists('sitew_texts');
    }
}
