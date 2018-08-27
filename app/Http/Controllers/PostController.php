<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Image;

class PostController extends Controller
{

    public function index() //CRUD - Read
    {
        //create a variable and store all the blog posts in it from the database
        $posts = Post::all();

        //return a view and pass in the above variable
        return view('posts.index')->withPosts($posts);
    }





    public function create() //CRUD - Create
    {
        return view('posts.create');
    }





    public function store(Request $request) /*Post rules*/
    {

       //validate data
       $this->validate($request, array(  /*verified CSRF*/
       'title' => 'required|max:255',
       'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
       'body' => 'required'
     ));

     //store in the database
     $post = new Post;
     $post->title = $request->title;
     $post->slug = $request->slug;
     $post->body = $request->body;

    //save our image
    if($request->hasFile('featured_image')){
       $image = $request->file('featured_image');
       $filename = time() . '.' . $image->getClientOriginalExtension();
       $location = public_path('images/' . $filename);
       Image::make($image)->resize(800, 400)->save($location);

       $post->image = $filename;

    }

     $post->save();

     return redirect()->route('posts.show', $post->id);



    }





    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }






    public function edit($id)  /* CRUD */
    {
        // find the post in the database and save as var
        $post = Post::find($id);
       // return the view and pass in the var
       return view('posts.edit')->withPost($post);
    }





    public function update(Request $request, $id)  /* CRUD */
    {
        // Validate the data
        $post = Post::find($id);
      if ($request->input('slug') == $post->slug) {
        $this->validate($request, array(  /*verified CSRF*/
        'title' => 'required|max:255',
        'body' => 'required'
      ));
    } else {
        $this->validate($request, array(  /*verified CSRF*/
        'title' => 'required|max:255',
        'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
        'body' => 'required'
      ));
    }

        // Save the data to the database
         $post = Post::find($id);

         $post->title = $request->input('title');
         $post->slug = $request->input('slug');
         $post->body = $request->input('body');

         $post->save();

        //Redirect with flashdata to the posts.show

        return redirect()->route('posts.show', $post->id);
    }







    public function destroy($id)    /* CRUD */
    {

      $post = Post::find($id);

      $post->delete();

      return redirect()->route('posts.index');

    }
}
