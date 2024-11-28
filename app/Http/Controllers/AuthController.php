<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function createNewToken($token)
    {
        $ttl = config('jwt.ttl');
        return response()->json([
            'token' => $token,
            'type' => 'bearer',
            'expired' => $ttl*60,
            'user' => auth()->user(),
        ]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed',
            'role'=> '',
            'skills'=>'',
            'phone'=>'',
            'location'=>'',
            'profile_picture'=>''
        ]);
        $imagePath = "";
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 412);
        }
        if( $request->hasFile('profile_picture')){
            $file = $request->file('profile_picture');
            $filename = str_replace(' ','',$request->name).uniqid().'.'.$file->clientExtension();
            $imagePath =  $file->storeAs('profiles',$filename, 'public');
        }
        $user = User::create(
            $validator->validated(),
            [
                "email"=>$request->email,
                "password" => bcrypt($request->password),
                "name" =>$request->name,
                "role" =>$request->role,
                "profile_picture" => $imagePath,
                "bio" => $request->bio,
                "skills" => $request->skills,
                "phone" => $request->phone,
                "location"=>$request->location
            ],
        );
        return response()->json([
            'user' => $user,
        ], 201)
            ->header('Access-Control-Allow-Origin', 'http://localhost:3000','http://localhost:3001')
            ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization')
        ;
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'email ou mot de pass incorrect'], 401);
        }
        if (!$token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['error' => 'invalide cridentials'], 401);
        }
        // Générer le token
        $token = $this->createNewToken($token);

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token->original,
        ]);
    }
}
