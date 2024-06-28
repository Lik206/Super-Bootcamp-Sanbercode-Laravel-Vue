<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register','login']]);
    }

    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $roleUser = Roles::where('name', 'user')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleUser->id
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'User berhasil di register',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (! $user = auth()->attempt($credentials)) {
            return response()->json(['error' => 'User Invalid'], 401);
        }

        $dataUser = User::where('email', $request['email'])->first();
        $token = JWTAuth::fromUser($dataUser);

        return response()->json([
            'message' => 'user berhasil login',
            'user' => $dataUser,
            'token' => $token
        ]);

    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Logout berhasil']);
    }

    public function getUser() {
        $user = auth()->user() ;
        return response()->json([
            "message" => "Profile berhasil ditampilkan",
            "user" => $user
        ]);
    }

    public function updateUser(Request $request) {
        $getUser = auth()->user();
        $user = User::find($getUser->id);

        $user->name = $request['name'];

        $user->save();

        return response()->json([
            'message' => 'User name berhasil di update'
        ],201);
    }
}
