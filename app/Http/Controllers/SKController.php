<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SM;
use App\Models\SK;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class SKController extends Controller
{
    public function index(){

        $id_user = Auth::id();
        $sk = SK::where('id_pengirim', $id_user)->orderBy('tgl_sk')->get();
        
        if(!$sk){
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json(['status'=>'sukses','data' => $sk], 200);

    }
    public function create(Request $request){
        $id_user = Auth::id();
        $id_penerima=$request->id_penerima;
        $currentDate = Carbon::now()->format('Y-m-d');
        $sk = SK::create([
            'no_surat'=>$request->no_surat,
            'tgl_ns'=>$request->tgl_ns,
            'pengirim'=>$request->pengirim,
            'penerima'=>$request->penerima,
            'perihal'=>$request->perihal,
            'id_bagian'=>$request->id_bagian,
            'token_lampiran'=>$request->token_lampiran,
            "isi"=>$request->isi,
            'dibaca'=>$request->dibaca,
            'disposisi'=>$request->disposisi,
            'peringatan'=>$request->peringatan,
            'id_user'=>$id_user,
            'tgl_sk'=>$currentDate,
            'id_pengirim'=>$id_user,
            'id_penerima'=>$id_penerima
        ]);

        $no_asal = $sk->no_surat;
        $tgl_asal = $sk->tgl_sk;

        $sm = SM::create([
            'no_surat'=>$request->no_surat,
            'tgl_ns'=>$request->tgl_ns,
            'no_asal'=>$no_asal,
            'tgl_no_asal'=>$tgl_asal,
            'pengirim'=>$request->pengirim,
            'penerima'=>$request->penerima,
            'perihal'=>$request->perihal,
            "isi"=>$request->isi,
            'token_lampiran'=>$request->token_lampiran,
            'dibaca'=>0,
            'disposisi'=>0,
            'id_user'=>$id_user,
            'tgl_sm'=>$currentDate,
            'id_pengirim'=>$id_user,
            'id_penerima'=>$id_penerima
        ]);

        if (!$sk) {
            return response()->json(['status' => 'error', 'message' => 'Gagal membuat surat.']);
        }
        return response()->json(['status' => 'sukses', 'data' => $sk]);
    }
}
