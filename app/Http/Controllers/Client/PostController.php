<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseJson;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public $response;
    public $query;
    public function __construct(ResponseJson $response)
    {
        $this->response = $response;
        $this->query = Post::where('is_active', 1);

    }
    public function index(Request $request)
    {
        $posts = $this->query->orderByDesc('created_at')->get();
        $posts_feature = Post::where('is_active', 1)->orderByDesc('views')->take(3)->get();
        foreach ($posts as $post) {
            $post->comments = $post->comments()->count('comments');
        }
        foreach ($posts_feature as $post) {
            $post->comments = $post->comments()->count('comments');
        }
        $data = [
            'posts' => $posts,
            'posts_feature' => $posts_feature
        ];
        if ($data) {
            return $this->response->responseSuccess($data);
        }
        return $this->response->responseFailed();

    }
    public function show(Request $request)
    {
        $post = $this->query->where('slug', $request->slug)->first();
        if ($post) {
            $post->comments = $post->comments()->orderByDesc('created_at')->get();
            foreach ($post->comments as $comment) {
                $comment->user = $comment->user()->get(['name', 'avatar']);
            }
            $this->query->update(['views' => $post->views += 1]);
            return $this->response->responseSuccess($post);
        }
        return $this->response->responseFailed();
    }
}
