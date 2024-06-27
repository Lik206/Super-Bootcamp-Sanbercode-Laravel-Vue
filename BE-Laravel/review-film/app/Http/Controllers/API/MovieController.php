<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movie = Movie::all();

        if($movie->isEmpty()) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ],404);
        }

        return response()->json([
            'message' => 'Tampil Data berhasil',
            'data' => $movie
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {
        $data = $request->validated();

        // jika file gambar diinput

        if ($request->hasFile('poster')) {

            // membuat unique name pada gamabr yang di input

            $imageName = time() . '.' . $request->poster->extension();

            // simpan gambar pada file storage

            $request->poster->storeAs('public/images', $imageName);

            // menganti request nilai request image menjadi $imageName yang baru bukan berdasarkan request
            $path = Storage::url('images/' . $imageName);
            $data['poster'] = env('APP_URL') . $path;
        }

        // untuk memastikan supaya request dari year adalah string dari tahun
        $yearReq = $request->input('year');
        $year = intval($yearReq);
        $year = (string) $year;
        if($year === '0') {
            return response()->json([
                'message' => 'year tidak boleh 0'
            ], 422);
        }
        $data['year'] = $year;

        
        Movie::create($data);
        
        return response()->json([
            'message' => 'Tambah Movie berhasil'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::find($id);

        if (is_null($movie)) {
            return response()->json([
                'message' => "data berdasarkan id: $id tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'message' => "Detail Data movie",
            'data' => $movie
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieRequest $request, string $id)
    {
        $data = $request->validated();

        $movie = Movie::find($id);

        if (is_null($movie)) {
            return response()->json([
                'message' => "data berdasarkan id: $id tidak ditemukan"
            ], 404);
        }


        if ($request->hasFile('poster')) {

            // Hapus gambar lama jika ada
            if ($movie->poster) {
                $getMovie = basename($movie->poster);

                Storage::delete('public/images/' . $getMovie);
    
            }


            $imageName = time() . '.' . $request->poster->extension();

            $request->poster->storeAs('public/images', $imageName);

            $data['poster'] = $imageName;
        }
        
        $yearReq = $request->input('year');
        $year = intval($yearReq);
        $year = (string) $year;
        if ($year === '0') {
            return response()->json([
                'message' => 'year tidak boleh 0'
            ], 422);
        }
        $data['year'] = $year;
        
        $movie->update($data);
        return response()->json([
            'message' => 'Update Movie berhasil'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::find($id);

        if (is_null($movie)) {
            return response()->json([
                'message' => "data berdasarkan id: $id tidak ditemukan"
            ], 404);
        }

        if ($movie->poster) {
            $getMovie = basename($movie->poster);

            Storage::delete('public/images/' . $getMovie);
        }

        $movie->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
