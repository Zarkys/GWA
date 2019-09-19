<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{

    public function up()
    {
         Schema::create('sitew_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->integer('active')->default(\Modules\Website\Models\Enums\ActiveSection::$activated);
            $table->timestamps();
        });
    }

    public function down()
    {
       Schema::dropIfExists('sitew_sections');
    }
}