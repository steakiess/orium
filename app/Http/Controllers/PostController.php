<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostCreateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $query = Post::with(['user'])
            ->withCount('claps')
            ->latest();

        if ($user) {
            $ids = $user->following()->pluck('users.id');
            $ids->push($user->id); // 👈🏻 include the user that created the post
            $query->whereIn('user_id', $ids);
        }

        $posts = $query->simplePaginate(5);
        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('post.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();

        $image = $data['image'];
        // unset($data['image']);
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title'], '-');

        $imagePath = $image->store('posts', 'public');
        $data['image'] = $imagePath;

        Post::create($data);

        return redirect()->route('dashboard')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::get();
        return view('post.edit', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostCreateRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validated();
        $image = $data['image'];
        $imagePath = $image->store('posts', 'public');
        $data['image'] = $imagePath;

        $post->update($data);

        // if($data['image'] ?? false){

        // }

        return redirect()->route('myPost');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        $post->delete();
        return redirect()->route('dashboard');
    }

    public function category(Category $category)
    {
        $posts = $category
            ->posts()
            ->with(['user'])
            ->withCount('claps')
            ->latest()
            ->simplePaginate(5);
        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    public function myPost(Category $category)
    {
        $user = auth()->user();
        $posts = $user
            ->posts()
            ->with(['user'])
            ->withCount('claps')
            ->latest()
            ->simplePaginate(5);
        return view('post.index', [
            'posts' => $posts,
        ]);
    }
}
