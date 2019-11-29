<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->longText('comment');
            $table->dateTime('publication_date')->nullable();
            $table->integer('id_post')->unsigned();
            $table->integer('status')->default(\Modules\Blog\Models\Enums\StatusCommentBlog::$revision);

            $table->foreign('id_post')->references('id')->on('blog_posts')->onDelete('cascade');
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
        Schema::drop('blog_comments');
    }
}
