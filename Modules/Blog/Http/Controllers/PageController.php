<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Blog\Models\Entities\CategoryBlog;
use Modules\Blog\Models\Entities\CommentBlog;
use Modules\Blog\Models\Entities\Post;
use Modules\Blog\Models\Enums\StatusCommentBlog;

class PageController extends Controller
{

    public function blog()
    {

        $posts = Post::orderBy('id', 'DESC')->get();

        return view('blog::landing.posts', compact('posts'));
    }

    public function category($slug)
    {
        $category = CategoryBlog::where('slug', $slug)->pluck('id')->first();

        $posts = Post::with([
            'category', 'tags', 'comments',
        ])->where('id_category', $category)
            ->orderBy('id', 'DESC')->get();

        return view('blog::landing.posts', compact('posts'));
    }

    public function tag($slug)
    {
        $posts = Post::with([
            'category', 'tags', 'comments',
        ])->whereHas('tags', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })
            ->orderBy('id', 'DESC')->get();

        return view('blog::landing.posts', compact('posts'));
    }

    public function post($slug)
    {
        $post = Post::with([
            'category', 'tags', 'comments' => function ($query) {
                $query->where('status', StatusCommentBlog::$published)->get();
            }
        ])->where('slug', $slug)->first();

        return view('blog::landing.post', compact('post'));
    }

    public function saveComment(Request $request)
    {

        $comment = new CommentBlog();
        $comment->name = $request->get('name');
        $comment->email = $request->get('email');
        $comment->comment = $request->get('comment');
        $comment->publication_date = New Carbon();
        $comment->id_post = $request->get('id_post');
        $comment->save();

        $response = [
            'status' => 'OK',
            'code' => 200,
            'message' => __('Datos Obtenidos Correctamente'),
        ];

        return response()->json($response, 200);

    }

}
