<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;

class BlogController extends Controller
{

  public function getIndex() {

    $posts = Post::all();

    return view('blog.index')->withPosts($posts);
  }
    public function getSingle($slug) {
    //fetch from database on slug
    $post = Post::where('slug', '=', $slug)->first();

    return view('blog.single')->withPost($post);


    }
}
