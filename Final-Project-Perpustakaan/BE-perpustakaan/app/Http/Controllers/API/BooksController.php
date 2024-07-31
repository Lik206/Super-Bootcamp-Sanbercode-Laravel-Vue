<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'isOwner'])->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::with('category')->get();

        if ($books->isEmpty()) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Data berhasil ditampilkan',
            'data' => $books
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'summary' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
            'stok' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id|uuid',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);

            $path = Storage::url('images/' . $imageName);
        }

        $createBook = [
            'title' => $request->title,
            'summary' => $request->summary,
            'image' => env('APP_URL') . $path,
            'stok' => $request->stok,
            'category_id' => $request->category_id,
        ];
        
        Books::create($createBook);

        return response()->json([
            'message' => 'Data berhasil ditambahkan'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Books::with('listBorrows')->find($id);

        if (is_null($book)) {
            return response()->json([
                'message' => "data berdasarkan id: $id tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'message' => "Data detail ditampilkan",
            'data' => $book
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'summary' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
            'stok' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id|uuid',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $book = Books::find($id);

        if (is_null($book)) {
            return response()->json([
                'message' => "data berdasarkan id: $id tidak ditemukan"
            ], 404);
        }

        if ($request->hasFile('image')) {

            if ($book->image) {
                $oldImage = basename($book->image);
                Storage::delete('public/images/' . $oldImage);
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);

            $imagePath = Storage::url('images/' . $imageName);
        }

        $book->title = $request->title;
        $book->summary = $request->summary;
        if ($request->hasFile('image')) {
            $book->image = env('APP_URL') . $imagePath;
        }
        $book->stok = $request->stok;
        $book->category_id = $request->category_id;


        $book->save();

        return response()->json([
            'message' => 'Data berhasil di update'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Books::find($id);

        if (is_null($book)) {
            return response()->json([
                'message' => "data berdasarkan id: $id tidak ditemukan"
            ], 404);
        }

        if ($book->poster) {
            $getImage = basename($book->image);

            Storage::delete('public/images/' . $getImage);
        }

        $book->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
