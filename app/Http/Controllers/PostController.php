<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function deletePost (Post $post) {
        
        // hapus post
        $post->delete();
        return redirect('/home');

    }

    //untuk update post
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

    //join table
    public function laporan ()
    {
        $posts = DB::table('posts')
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*','users.name as user_name')
            ->get();
        return view('/laporan', compact('posts'));
    }

    //ekspor pdf

    public function eksporPdf()
    {
        // Ambil data posts dari database
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name as user_name')
            ->get();

        // Load view untuk PDF dan kirim data
        $pdf = FacadePdf::loadView('/pdf', ['posts' => $posts]);

        // Unduh file PDF
        return $pdf->download('laporan.pdf');
    }
}