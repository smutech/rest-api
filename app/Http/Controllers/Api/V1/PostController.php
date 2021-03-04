<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(20);

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['title', 'body', 'category_id']);
        $rules = [
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:5',
            'category_id' => 'required',
        ];
        $messages = [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least :min characters.',
            'title.min' => 'The title must not be more than :max characters.',
            'body.required' => 'The body field is required.',
            'body.min' => 'The body field must be at least :min characters.',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response(['error' => $validator->errors()], 400);
        }

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ]);

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (! $post) {
            return response(['error' => 'Invalid ID'], 404);
        }

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (! $post) {
            return response(['error' => 'Invalid ID'], 404);
        }

        $data = $request->only(['title', 'body', 'category_id']);
        $rules = [
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:5',
            'category_id' => 'required',
        ];
        $messages = [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least :min characters.',
            'title.min' => 'The title must not be more than :max characters.',
            'body.required' => 'The body field is required.',
            'body.min' => 'The body field must be at least :min characters.',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response(['error' => $validator->errors()], 400);
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ]);

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (! $post) {
            return response(['error' => 'Invalid ID'], 404);
        }

        $post->delete();

        return response(null, 204);
    }
}
