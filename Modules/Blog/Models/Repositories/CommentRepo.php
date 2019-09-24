<?php

namespace Modules\Blog\Models\Repositories;

use Modules\Blog\Models\Entities\CommentBlog;

class CommentRepo
{
    public function all()
    {

        $comments = CommentBlog::all();
        return $comments;

    }

    public function allStatus($status)
    {
        $comments = CommentBlog::where(['status' => $status])->get();

        return $comments;
    }

    public function find($id)
    {

        $comments = CommentBlog::find($id);

        return $comments;
    }

    public function store($data)
    {

        $comments = new CommentBlog();
        $comments->fill($data);
        $comments->save();

        return $comments;
    }

    public function update($comments, $data)
    {

        $comments->fill($data);
        $comments->save();

        return $comments;
    }

    public function delete($id)
    {

        $comments = CommentBlog::destroy($id);

        return $comments;
    }

    public function findbyid($id)
    {

        $comments = CommentBlog::find($id);


        return $comments;
    }

}
