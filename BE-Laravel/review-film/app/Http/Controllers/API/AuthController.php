<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\GenerateOtp;
use App\Mail\RegisterMail;
use App\Models\OtpCode;
use App\Models\Roles;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register','login',]]);
        $this->middleware('isVerificationAccount')->only('updateUser');
    }

    protected function createOtpCode($user) {
        do {
            $randomNumber = mt_rand(100000, 999999);
            $checkOtp = OtpCode::where('otp', $randomNumber)->first();
        } while ($checkOtp);

        $now = Carbon::now();

        OtpCode::updateOrCreate(
            ['user_id' => $user->id],
            [
                'otp' => $randomNumber,
                'valid_until' => $now->addMinutes(5)
            ]
        );

    }

    public function generateOtpcode(Request $request) {
        $request->validate([
            'email' => 'required|email'
        ]);

        $getUser = auth()->user();

        if($getUser->email !== $request->email) {
            return response()->json([
                'message' => 'token user tidak valid'
            ], 401);
        }

        $userData = User::where('email', $request->email)->first();

        $this->createOtpCode($userData);
        Mail::to($userData->email)->queue(new GenerateOtp($userData));
        

        return response()->json([
            'message' => 'berhasil generate ulang otp code',
            
        ]);
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

        $this->createOtpCode($user);
        Mail::to($user->email)->queue(new RegisterMail($user));

        $token = JWTAuth::fromUser($user);


        return response()->json([
            'message' => 'User berhasil di register',
            'token' => $token,
            'user' => $user
        ]);
    }

    public function verifikasi(Request $request) {
        $request->validate([
            'otp' => 'required'
        ]);

        $otp_code = OtpCode::where('otp', $request->otp)->first();

        if(!$otp_code) {
            return response()->json([
                'message' => 'Kode Otp tidak ditemukan'
            ],404);
        }

        $now = Carbon::now();

        if($now > $otp_code->valid_until) {
            return response()->json([
                'message' => 'Kode Otp sudah kadaluarsa silahkan generate ulang',
            ],400);
        }

        $authUser = auth()->user();

        if($otp_code->user_id !== $authUser->id) {
            return response()->json([
                'message' => 'token user tidak valid'
            ], 401);
        }

        $user = User::find($otp_code->user_id);
        $user->email_verified_at = $now;
        $user->save();

        $otp_code->delete();

        return response()->json([
            'message' => 'Berhasil verifikasi akun'
        ], 200);

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
