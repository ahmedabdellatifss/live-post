<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Notification;

use App\Http\Requests\UpdatePostRequest;
use App\Rules\IntegerArray;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;
use App\Http\Requests\PostStoreRequest;
use App\Notifications\PostSharedNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

/**
 * @group Post Management
 * APIs to manage post.
*/
class PostController extends Controller
{
    /**
     * Display a listing of posts.
     *
     * Gets a list of posts.
     *
     * @queryParam page_size int Size per page. Defaults to 20. Example: 20
     * @queryParam page int Page to view. Example: 1
     *
     * @apiResourceCollection App\Http\Resources\PostResource
     * @apiResourceModel App\Models\Post
     * @return ResourceCollection
     */
    public function index()
    {

        $posts = Post::query()->paginate(10);

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created post in storage.
     * @bodyParam title string required Title of the post. Example: Amazing Post
     * @bodyParam body string[] required Body of the post. Example: ["This post is super beautiful"]
     * @bodyParam user_ids int[] required The author ids of the post. Example: [1, 2]
     * @apiResource App\Http\Resources\PostResource
     * @apiResourceModel App\Models\Post
     * @param  PostStoreRequest  $request
     * @return PostResource
     */
    public function store(Request $request, PostRepository $repository)
    {
        $payload = $request->only([
            'title',
            'body',
            'user_ids'
        ]);

        $validator = Validator::make($payload ,
        [
            'title' => 'string|required',
            'body' => ['array', 'required'],
            'user_ids' => [
                'array',
                'required',
                new IntegerArray()
            ]
        ],[
            'body.required' => "Please enter a value for body.",
            'title.string' => 'HEYYYY use a string',
        ],[
            'user_ids'=>"USER IDDD"
        ]);
        $validator->validate();
        $created = $repository->create($payload);

        return new PostResource($created);
    }
    /**
     * Display the specified post.
     * @apiResource App\Http\Resources\PostResource
     * @apiResourceModel App\Models\Post
     * @param  \App\Models\Post  $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }


    /**
     * Update the specified post in storage.
     * @bodyParam title string required Title of the post. Example: Amazing Post
     * @bodyParam body string[] required Body of the post. Example: ["This post is super beautiful"]
     * @bodyParam user_ids int[] required The author ids of the post. Example: [1, 2]
     * @apiResource App\Http\Resources\PostResource
     * @apiResourceModel App\Models\Post
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return PostResource | JsonResponse
     */
    public function update(Request $request, Post $post, PostRepository $repository)
    {
        $post = $repository->update($post, $request->only([
            'title',
            'body',
            'user_ids',
        ]));
        return new PostResource($post);

    }


    /**
     * Remove the specified post from storage.
     * @response 200 {
        "data": "success"
     * }
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post, PostRepository $repository)
    {
        $post = $repository->forceDelete($post);
        return new JsonResponse([
            'data' => 'success'
        ]);
    }

    /**
     * Share a specified post from storage.
     * @response 200 {
            "data": "signed url..."
     * }
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function share(Request $request, Post $post)
    {
        $url = URL::temporarySignedRoute('shared.post', now()->addDays(30), [
            'post' => $post->id,
        ]);

        // send notification using Notification Facade
        $user = User::query()->whereIn('id', $request->user_ids)->get();
        Notification::send($user, new PostSharedNotification($post, $url));

        // or you can use notify in the user model
        // $user = User::query()->find(1);
        // $user->notify(new PostSharedNotification($post, $url));

        return new JsonResponse([
            'data' => $url,
        ]);
    }
}
