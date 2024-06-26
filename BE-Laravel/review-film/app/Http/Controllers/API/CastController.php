<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CastRequest;
use App\Http\Requests\UpdateCastRequest;
use App\Models\Cast;
use Illuminate\Http\Request;

class CastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $casts = Cast::all();

        if($casts->isEmpty()) {
            return response()->json([
                'message' => "data tidak ditemukan",
            ],404);
        }

        return response()->json([
            'message' => "tampil data berhasil",
            'data' => $casts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CastRequest $request)
    {
        Cast::create($request->all());

        return response()->json([
                'message' => 'Tambah Cast berhasil'
            ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cast = Cast::find($id);

        if(is_null($cast)) {
            return response()->json([
                'message' => "data berdasarkan id: $id tidak ditemukan"
            ],404);
        }

        return response()->json([
            'message' => "Detail Data Cast",
            'data' => $cast
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCastRequest $request, string $id)
    {
        $cast = Cast::find($id);

        if(is_null($cast)) {
            return response()->json([
                'message' => "id $id tidak ditemukan"
            ],404);
        }

        $cast->name = $request->input('name', $cast->name);
        $cast->bio = $request->input('bio', $cast->bio);
        $cast->age = $request->input('age', $cast->age);

        $cast->save();

        return response()->json([
            'message' => 'Update Cast Berhasil'
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cast = Cast::find($id);

        if (is_null($cast)) {
            return response()->json([
                'message' => "id $id tidak ditemukan"
            ],404);
        }

        $cast->delete();

        return response()->json([
            'message' => "data dengan id $id berhasil dihapus"
        ]);
    }
}
