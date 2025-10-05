<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\PostCreated;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::get();

        return view('posts', compact('posts'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $this->validate($request, [
             'title' => 'required',
             'body' => 'required'
        ]);
   
        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body
        ]);

        event(new PostCreated($post));
   
        return back()->with('success','Post created successfully.');
    }
}
