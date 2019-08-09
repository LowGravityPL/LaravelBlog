<?php
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/posts', function () {
    $posts = Post::with('category', 'user')->take(5)->get()->toArray();
    dd($posts);
});

Route::get('/posts/{id}/view', function($post_id) {
    $post = Post::with('category', 'user')->find($post_id)->toArray();
    dd($post);
})->where('id', '[0-9]+');

Route::get('/posts/create', function (Request $request) {
    $data = [
        'categories' => Category::all(),
        'users' => User::all(),
    ];

    return view('posts.create', $data);
});

Route::post('/posts/create', function (Request $request) {
    // Validate and save post.
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'post_image' => 'image',
        'category' => 'exists:categories,id',
        'user' => 'exists:users,id'
    ]);

    $post = new Post();
    $post->title = $request->input('title');
    $post->content = $request->input('content');
    $post->image = $request->file('post_image')->store('post_images');
    $post->category()->associate($request->input('category'));
    $post->user()->associate($request->input('user'));
    $post->save();

    dd($post);
});
