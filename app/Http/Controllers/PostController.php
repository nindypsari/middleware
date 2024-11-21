<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function deletePost (Post $post) {
        
        // hapus post
        $post->delete();
        return redirect('/home');

    }

    public function actuallyUpdatePost(Post $post, Request $request) {

        //Gate::authorize('update-post',$post);
        $incomingField = $request->validate([
            'title' => 'required',
            'body' => 'required'

        ]);
        $incomingField['title'] = strip_tags($incomingField['title']);
        $incomingField['body'] = strip_tags($incomingField['body']);

        $post->update($incomingField);
        return redirect('/home');

    }


    public function showEditScreen(Post $post) {
        return view('edit-post',['post' => $post]);
    }

    public function createPost(Request $request) {
        $incomingField = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]); //memastikan semua kolom terisi


        //membersihkan input dari tag html
        $incomingField['title'] = strip_tags($incomingField['title']);
        $incomingField['body'] = strip_tags($incomingField['body']);

        
        $incomingField['user_id'] = Auth::id();
        Post::create($incomingField); //untuk post data
        return redirect('/home');

    }
}
