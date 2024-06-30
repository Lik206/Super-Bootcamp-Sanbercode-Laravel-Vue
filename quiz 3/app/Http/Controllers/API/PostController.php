<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::all();

        if($post->isEmpty()) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ],404);
        }

        return response()->json([
            'message' => 'Tampil Data berhasil',
            'data' => $post
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        Post::create($request->all());

        return response()->json([
            'message' => 'berhasil di posting',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if (is_null($post)) {
            return response()->json([
                'message' => "data berdasarkan id: $id tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'message' => "Detail Data Post",
            'data' => $post
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $post = Post::find($id);

        if (is_null($post)) {
            return response()->json([
                'message' => "id $id tidak ditemukan"
            ], 404);
        }

        $post->title = $request->input('title', $post->title);
        $post->content = $request->input('content', $post->content);


        $post->update();

        return response()->json([
            'message' => 'Update Post Berhasil'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (is_null($post)) {
            return response()->json([
                'message' => "id $id tidak ditemukan"
            ], 404);
        }

        $post->delete();

        return response()->json([
            'message' => "data dengan id $id berhasil dihapus"
        ]);
    }
}
