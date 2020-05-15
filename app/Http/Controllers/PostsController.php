<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {
    	return view('posts.create');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::with('user')
            ->whereIn('posts.user_id', $users)
            ->latest()
            ->paginate(5);

        return view('posts.index', compact('posts'));

    }

    public function show(Post $post)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->profile) : false; 
        return view('posts.show', compact('post', 'follows'));
    }

    public function store()
    {

    	$data = request()->validate([
    		'caption' => 'required',
    		'image' => ['required', 'image'],
    	]);

    	$imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);

    	auth()->user()->posts()->create([
    		'caption' => $data['caption'],
    		'image' => $imagePath,
    	]);

    	return redirect('/profile/' . auth()->user()->id);
    }
}
