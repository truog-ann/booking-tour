<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        foreach(Post::all() as $tour){
            $tour->update([
                'slug'=>Str::slug($tour->title)
            ]);
        }
        $query = Post::query();
        if ($request->title && $request->title != null) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if (isset($request->is_active)) {
            $query->where('is_active', intval($request->is_active));
        }
        $posts = $query->orderByDesc('created_at')->paginate(10);
        $title = "Posts list";
        return view('admin.Posts.index', compact('posts', 'title'));
    }

    public function create()
    {
        $title = "Post add";
        return view('admin.Posts.add', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'file' => 'required|max:2048|image',
            'is_active' => 'nullable'
        ]);
        $slug = Str::slug($request->title);
        $checkSlug = Post::where('slug', $slug)->get('id');
        if ($checkSlug) {
            $request->merge(['slug' => $slug . '-' . Str::random(3)]);
        } else {
            $request->merge(['slug' => $slug]);
        }
        $request->is_active ? $request->is_active : $request->merge(['is_active' => 0]);
        $thumbnail = $request->file('file');
        $imageName = "storage/posts/" . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->move(public_path('storage/posts'), $imageName);
        $request->merge(['thumbnail' => $imageName]);
        $request->merge(['views' => 0]);
        $post = Post::create($request->all());
        if ($post) {
            return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        }
        return redirect()->route('posts.index')->with('error', 'Post created faild.');

    }

    public function show(Post $post)
    {
        $title = "Post show";

        return view('admin.Posts.show', compact('post', 'title'));
    }

    public function edit(Post $post)
    {
        $title = "Post edit";
        return view('admin.Posts.edit', compact('title', 'post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'is_active' => 'nullable'
        ]);
        $request->is_active ? $request->is_active : $request->merge(['is_active' => 0]);
        $slug = Str::slug($request->title);
        $checkSlug = Post::where('slug', $slug)->get('id');
        if ($checkSlug) {
            $request->merge(['slug' => $slug . '-' . Str::random(3)]);
        } else {
            $request->merge(['slug' => $slug]);
        }
        if ($request->hasFile('file')) {
            if ($post->thumbnail) {
                Storage::delete($post->thumbnail);
            }
            $thumbnail = $request->file('file');
            $imageName = "storage/posts/" . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('storage/posts'), $imageName);
            $request->merge(['thumbnail' => $imageName]);
            $post->update($request->all());
        } else {
            $post->update($request->all());
        }


        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $imagePath =  public_path($post->thumbnail);
        if(file_exists($imagePath)){
            unlink($imagePath);
        }
        PostComment::where('post_id', $post->id)->delete();
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}