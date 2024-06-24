<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\MovieRequest;

class MovieController extends Controller
{
    public function store(MovieRequest $request): JsonResponse {
        return response()->json([
            'message' => 'BERHASIL!! movie berhasil di input'
        ],200);
    }
}
