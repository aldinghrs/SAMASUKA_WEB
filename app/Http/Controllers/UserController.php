<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request){
        if (!Auth::attempt($request->only('username', 'password')))
        {
            return response()
                ->json(['message' => 'Wrong username or password'], 401);
        }
        
        $user = User::where('username', $request['username'])->firstOrFail();
        $nama = $user->nama_lengkap;
        $alamat = $user->alamat;
        $telp = $user->telp;
        $level = $user->level;
        $id_user = $id_user;
        
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['name'=>$name,'message' => 'Hi '.$user->name.', welcome to home','access_token' => $token, 'token_type' => 'Bearer','id_role'=>$idRole, 'role'=>$roleName ]);
    }

    public function getUsers(){
        $id_user = Auth::id();
        $sm = User::where('id_user', '<>', $id_user)->where('level', 'user')->where('status','aktif')->orderBy('nama_lengkap')->get();
        
        if(!$sm){
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json(['status'=>'sukses','data' => $sm], 200);
    }
}
