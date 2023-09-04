<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request){
        $filds = $request->validate([
            'title' => ['required', 'min: 3', 'max: 50'],
            'body' => ['required', 'min: 3', 'max: 500'],
        ]);

        $filds['title'] = strip_tags($filds['title']);
        $filds['body'] = strip_tags($filds['body']);
        $filds['user_id'] = auth()->id();
        Post::create($filds);

        return redirect('/');
    }

    public function editPost(Post $post){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }
        return view('/edit-post', ['post' => $post]);
    }

    public function updatePost(Post $post, Request $request){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        $fields = $request->validate([
            'title'=> 'required',
            'body' => 'required'
        ]);

        $fields['title'] = strip_tags($fields['title']);
        $fields['body'] = strip_tags($fields['body']);

        $post -> update($fields);

        return redirect('/');
    }

    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){
           $post -> delete();
        }

        return redirect('/');
    }
}
