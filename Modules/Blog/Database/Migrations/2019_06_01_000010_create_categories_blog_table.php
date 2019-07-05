<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesBlogTable extends Migration
{

    public function up()
    {
        Schema::create('categories_blog', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->string('slug', 128)->unique();
            $table->mediumText('description')->nullable();
            $table->integer('id_user');
            $table->integer('active')->default(\Modules\Blog\Models\Enums\ActiveCategory::$activated);

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_blog');
    }
}
