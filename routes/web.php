<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;



Route::get('/', function () {
    return view('register');
});

Route::get('/about', function () {
    return view('about');
});



// untuk route register
Route::post('/register', [UserController::class,'register']);

Route::post('/logout', [UserController::class,'logout']);

Route::post('/login', [UserController::class,'login']);


//blog post related routes
Route::get('/home', function () {
    $posts = Post::all(); //menampilkan semua artikel yang telah di input
     return view('home', ['posts' => $posts]);
 });



Route::get('/home', function () {

    $posts = Post::where('user_id', Auth::id())->get(); //menampilkan artikel yang hanya diinput oleh user tsb
    return view('home', ['posts' => $posts]);
});


//Route::post('/create-post', [PostController::class,'createPost']);
//Route::get('/edit-post/{post}',[PostController::class,'showEditScreen']);
//Route::put('/edit-post/{post}',[PostController::class,'actuallyUpdatePost']);
Route::delete('/delete-post/{post}',[PostController::class,'deletePost']);


Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/edit-post/{post}',[PostController::class,'showEditScreen']);
    Route::put('/edit-post/{post}',[PostController::class,'actuallyUpdatePost']);
    //menampilkan laporan
    Route::get('/laporan', [PostController::class, 'laporan']);
    //download pdf
    Route::get('/pdf', [PostController::class, 'eksporPdf'])->name('laporan');

    });


Route::middleware([RoleMiddleware::class . ':admin,user'])->group(function () {
    Route::post('/create-post', [PostController::class,'createPost']);

});