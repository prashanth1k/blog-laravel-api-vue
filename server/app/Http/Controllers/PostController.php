<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostGetResource;
use App\Models\Post;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [new Middleware('auth:sanctum', except: ['index', 'show'])];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $posts = Post::with('user')->latest()->get();
        return PostGetResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $postin = $request->validated();

        $post = $request->user()->posts()->create($postin);
        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //

        // $post = Post::find($post);

        // dd($post);
        return new PostGetResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
        Gate::authorize('update', $post);
        $post->update($request->validated());
        return new PostGetResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        Gate::authorize('delete', $post);
        $post->delete();
        return response()->noContent();
    }
}
