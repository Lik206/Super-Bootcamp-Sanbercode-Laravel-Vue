<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'isVerificationAccount']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'critic' => 'required',
            'rating' => 'required|integer|between:1,5',
            'movie_id' => 'required|exists:movie,id|uuid'
        ]);
        $getUser = auth()->user();

        Reviews::updateOrCreate(
            ['user_id' => $getUser->id],
            [
                'critics' => $request['critic'],
                'rating' => $request['rating'],
                'movie_id' => $request['movie_id'],
            ]
        );

        $data = Reviews::where('user_id', $getUser->id)->first();

        return response()->json([
            'message' => 'Reviews berhasil dibuat/diubah',
            'data' => $data
        ]);
    }
}
