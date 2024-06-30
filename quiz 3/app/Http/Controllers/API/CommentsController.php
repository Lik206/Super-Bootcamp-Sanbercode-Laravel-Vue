<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comments;
use Illuminate\Http\Request;


class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comments::all();

        if ($comments->isEmpty()) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Tampil Data berhasil',
            'data' => $comments
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        Comments::create($request->all());

        return response()->json([
            'message' => 'berhasil di posting',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comments::find($id);

        if (is_null($comment)) {
            return response()->json([
                'message' => "data berdasarkan id: $id tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'message' => "Detail Data Comment",
            'data' => $comment
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, string $id)
    {
        $comments = Comments::find($id);

        if (is_null($comments)) {
            return response()->json([
                'message' => "id $id tidak ditemukan"
            ], 404);
        }
        $comments->comment = $request->input('comment', $comments->comment);

        $comments->update();

        return response()->json([
            'message' => 'Update comment Berhasil'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comments = Comments::find($id);

        if (is_null($comments)) {
            return response()->json([
                'message' => "id $id tidak ditemukan"
            ], 404);
        }

        $comments->delete();

        return response()->json([
            'message' => "data dengan id $id berhasil dihapus"
        ]);
    }
}
