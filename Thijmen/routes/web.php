<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
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
        $document = YamlFrontMatter::parseFile($file);

        $posts = collect($files)
            ->map(function ($file) {
                $document = YamlFrontMatter::parseFile($file);

                return new Post(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug
                );
            });
    }

    return view('posts', [
        'posts' => $posts
    ]);
});

Route::get('posts', function () {
    return view('posts');
});

Route::get('posts/{post}', function ($slug) {
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    if (!file_exists($path)) {

        //ddd('file does not exist');
        return redirect('/');
        //abort(404);
    }

    $post = file_get_contents($path);

    return view('post', [
        'post' => $post
    ]);
})->where('post', '[A-z_\-]+'); //regular expression

Route::get('post/{post}', function ($slug) {
    $post = Post::find($slug);

    return view('post', [
        'post' => $post
    ]);
})->where('post', '[A-z_\-]+');
