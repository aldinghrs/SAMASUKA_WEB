<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SM;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SMController extends Controller
{
    public function index(){

        $id_user = Auth::id();
        $sm = SM::where('id_penerima', $id_user)->orderBy('tgl_sm')->get();
        
        if(!$sm){
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json(['status'=>'sukses','data' => $sm], 200);

    }

    public function updateRead($id_sm){
        $sm = SM::where('id_sm', $id_sm)->update(['dibaca' => 1]);
        if(!$sm){
            return response()->json(['status' => 'sukses', 'message' => 'Surat sudah pernah dibaca'], 200);
        }
        return response()->json(['status'=>'sukses','data' => $sm], 200);
    }

    public function getData($id_sm){
        $sm = SM::find($id_sm);

        if (!$sm) {
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['status' => 'sukses', 'data' => $sm]);

    }

    public function save(Request $request){
        $id_user = Auth::id();
        $currentDate = Carbon::now()->format('Y-m-d');
        $sm = SM::create([
            'no_surat'=>$request->no_surat,
            'tgl_ns'=>$request->tgl_ns,
            'no_asal'=>$request->no_asal,
            'tgl_no_asal'=>$request->tgl_no_asal,
            'pengirim'=>$request->pengirim,
            'penerima'=>$request->penerima,
            'perihal'=>$request->perihal,
            'token_lampiran'=>$request->token_lampiran,
            'dibaca'=>$request->dibaca,
            'disposisi'=>$request->disposisi,
            'id_user'=>$id_user,
            'tgl_sm'=>$currentDate,
            'isi'=>$request->isi
        ]);

        if (!$sm) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menambahkan data.']);
        }
        return response()->json(['status' => 'sukses', 'data' => $sm]);
    }
}
