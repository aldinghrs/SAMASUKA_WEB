<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SK extends Model
{
    use HasFactory;
    protected $table = 'tbl_sk';
    protected $primaryKey = 'id_sk';
    public $timestamps = false;
    protected $fillable = [
        'id_sk',
        'no_surat',
        'tgl_ns',
        'id_bagian',
        'pengirim',
        'penerima',
        'perihal',
        'token_lampiran',
        'dibaca',
        'disposisi',
        'peringatan',
        'id_user',
        'tgl_sk',
        'isi',
        'id_pengirim',
        'id_penerima'
    ];
}
