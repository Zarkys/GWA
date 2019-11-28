<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sli_sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('url');
            $table->integer('status')->default(\Modules\Sliders\Models\Enums\Status::$activated);
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('sli_sliders');
    }
}
