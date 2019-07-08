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
            $table->text('comment');
            $table->dateTime('publication_date')->nullable();
            $table->integer('id_post')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->integer('status')->default(\Modules\Blog\Models\Enums\StatusCommentBlog::$revision);

            $table->foreign('id_post')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }

}
