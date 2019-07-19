<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{

    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('comment');
            $table->dateTime('publication_date')->nullable();
            $table->integer('id_post')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('status')->default(\Modules\Blog\Models\Enums\StatusCommentBlog::$revision);

            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }

}
