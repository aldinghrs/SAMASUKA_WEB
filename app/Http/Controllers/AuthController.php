<?php

namespace App\Http\Controllers;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:tbl_user',
            'password' => 'required|min:5',
            'nama_lengkap' => 'required',
            'email' => 'required',
            'level' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'level' => $request->level,
            'status' => 'aktif'
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['status'=>'sukses','data' => $user,'access_token' => $token, 'token_type' => 'Bearer',], 201);
    }

    public function login(Request $request)
    {

        if (!Auth::attempt($request->only('username', 'password')))
        {
            return response()
                ->json(['message' => 'Wrong username or password'], 401);
        }

        $user = User::where('username', $request['username'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        

        return response()->json(['status' => 'sukses','data' => $user,'token'=>$token], 200);
    }
}
