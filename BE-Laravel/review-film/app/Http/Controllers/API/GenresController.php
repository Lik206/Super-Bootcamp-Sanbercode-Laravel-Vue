<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenresRequest;
use App\Http\Requests\UpdateGenres;
use App\Models\Genres;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genres::all();

        if ($genres->isEmpty()) {
            return response()->json([
                'message' => "data tidak ditemukan",
            ], 404);
        }

        return response()->json([
            'message' => "tampil data berhasil",
            'data' => $genres
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenresRequest $request)
    {
        Genres::create($request->all());

        return response()->json([
            'message' => "Tambah Genre berhasil"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genre = Genres::find($id);

        if (is_null($genre)) {
            return response()->json([
                'message' => "data berdasarkan id: $id tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'message' => "Detail Data genre",
            'data' => $genre
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenres $request, string $id)
    {
        $genre = Genres::find($id);

        if (is_null($genre)) {
            return response()->json([
                'message' => "id $id tidak ditemukan"
            ],404);
        }

        $genre->name = $request->input('name', $genre->name);


        $genre->save();

        return response()->json([
            'message' => 'Update Genre Berhasil'
        ], 201);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genre = Genres::find($id);

        if (is_null($genre)) {
            return response()->json([
                'message' => "id $id tidak ditemukan"
            ], 404);
        }

        $genre->delete();

        return response()->json([
            'message' => "data dengan id $id berhasil dihapus"
        ]);
    }
}
