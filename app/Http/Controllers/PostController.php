<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PostResource
     */
    public function index()
    {
        $posts = Post::query()->paginate(10);

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PostResource
     */
    public function store(Request $request)
    {
        $created = DB::transaction(function () use ($request) {

            $created = Post::query()->create([
                'title' => $request->title,
                'body' => $request->body,
            ]);
            if($userIds = $request->user_ids){
                $created->users()->sync($userIds);
            }
            return $created;
        });

        return new PostResource($created);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return PostResource | JsonResponse
     */
    public function update(Request $request, Post $post)
    {
        //$post->update($request->only(['title', 'body']));
        $updated = $post->update([
            'title' => $request->title ?? $post->title,
            'body' => $request->body ?? $post->body,
        ]);
        if(!$updated){
            return new JsonResponse([
                'error' => 'Failed to update model.'
            ], 400);
        }

        return new PostResource($post);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $deleted = $post->forceDelete();

        if(!$deleted){
            return new JsonResponse([
                'errors'=>[
                    'Could not delete resource.'
                ]
            ],400);
        }
        return new JsonResponse([
            'data'=>'success'
        ]);
    }
}
