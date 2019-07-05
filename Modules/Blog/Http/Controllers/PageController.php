<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Blog\Models\Entities\CategoryBlog;
use Modules\Blog\Models\Entities\Post;


class PageController extends Controller
{
    
    public function blog(){

        $posts = Post::orderBy('id', 'DESC')->get();

    	return view('blog::landing.posts', compact('posts'));
    }

    public function category($slug){
        $category = CategoryBlog::where('slug', $slug)->pluck('id')->first();

        $posts = Post::where('id_category', $category)
            ->orderBy('id', 'DESC')->get();

        return view('blog::landing.posts', compact('posts'));
    }

    public function tag($slug){
        $posts = Post::whereHas('tags', function($query) use ($slug) {
            $query->where('slug', $slug);
        })
        ->orderBy('id', 'DESC')->get();

        return view('blog::landing.posts', compact('posts'));
    }
//
    public function post($slug){
    	$post = Post::where('slug', $slug)->first();

    	return view('blog::landing.post', compact('post'));
    }

}
