<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'isVerificationAccount']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'age' => 'required|integer',
            'biodata' => 'required',
            'address' => 'required'
        ]);
        $getUser = auth()->user();

        Profile::updateOrCreate(
            ['user_id' => $getUser->id],
            [
                'age' => $request['age'],
                'biodata' => $request['biodata'],
                'address' => $request['address'],
            ]
        );

        $data = Profile::where('user_id', $getUser->id)->first();

        return response()->json([
            'message' => 'Profile berhasil dibuat/diubah',
            'data' => $data
        ]);

    }

}
