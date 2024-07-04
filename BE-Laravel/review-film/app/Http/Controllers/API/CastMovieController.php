<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CastMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CastMovieController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'onlyAdmin'])->except(['index', 'show']);
    }

    public function index()
    {
        $castMovie = CastMovie::all();

        if ($castMovie->isEmpty()) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Tampil Data berhasil',
            'data' => $castMovie
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'cast_id' => 'required|exists:cast,id|uuid',
            'movie_id' => 'required|exists:movie,id|uuid'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        CastMovie::create($request->all());

        return response()->json([
            'message' => "Tambah Cast Movie berhasil"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $castMovie = CastMovie::with('movie', 'cast')->find($id);

        if (is_null($castMovie)) {
            return response()->json([
                'message' => "data berdasarkan id: $id tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'message' => "Detail Data Cast",
            'data' => $castMovie
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $castMovie = CastMovie::find($id);

        if (is_null($castMovie)) {
            return response()->json([
                'message' => "id $id tidak ditemukan"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'cast_id' => 'required|exists:cast,id|uuid',
            'movie_id' => 'required|exists:movie,id|uuid'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $castMovie->name = $request['name'];
        $castMovie->cast_id = $request['cast_id'];
        $castMovie->movie_id = $request['movie_id'];

       $castMovie->save();

        return response()->json([
            'message' => 'Update Cast Movie Berhasil'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $castMovie = CastMovie::find($id);

        if (is_null($castMovie)) {
            return response()->json([
                'message' => "id $id tidak ditemukan"
            ], 404);
        }

        $castMovie->delete();

        return response()->json([
            'message' => "data dengan id $id berhasil dihapus"
        ]);
    }
}
