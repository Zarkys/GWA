<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{

    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 128);
            $table->string('slug', 128)->unique();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->integer('active')->default(\Modules\Blog\Models\Enums\ActivePost::$activated);
            $table->integer('status_post')->default(\Modules\Blog\Models\Enums\StatusPostBlog::$draft);
            $table->integer('id_user')->unsigned();
            $table->integer('id_category')->unsigned();
            $table->datetime('publication_date')->nullable();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_category')->references('id')->on('blog_categories_blog')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
