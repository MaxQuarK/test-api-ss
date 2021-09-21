<?php

namespace App\Http\Controllers;

use App\Http\Filters\PostFilter;
use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function create(PostRequest $request)
    {
        $postService = new PostService(Auth::user());
        return $postService->create($request);
    }

    public function showAll(PostFilter $filter)
    {
        $postService = new PostService(Auth::user());
        return $postService->showAll($filter);
    }

    public function edit(Post $post, PostRequest $request)
    {
        $postService = new PostService(Auth::user(), $post);
        return $postService->edit($request);
    }

    public function destroy(Post $post)
    {
        $postService = new PostService(Auth::user(), $post);
        return $postService->destroy();
    }
}
