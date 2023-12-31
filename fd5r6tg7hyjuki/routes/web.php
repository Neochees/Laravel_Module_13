<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter as Yaml;
use Illuminate\Support\Facades\File;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $files =  File::files(resource_path("posts/"));

    $posts = [];

    foreach ($files as $file) {
        $posts[] = new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body(),
            $document->slug
        );
    }

    return view('posts', [
        'posts' => Post::all()
    ]);
});

Route::get('post/{post}', function ($slug) {
    $post = Post::find($slug);
 
     return view('post', [
         'post' => $post 
     ]);
 })->where('post','[A-z_\-]+');