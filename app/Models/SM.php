<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SM extends Model
{
    use HasFactory;
    protected $table = 'tbl_sm';
    protected $primaryKey = 'id_sm';
    public $timestamps = false;
    protected $fillable = [
        'id_sm',
        'no_surat',
        'tgl_ns',
        'no_asal',
        'tgl_no_asal',
        'pengirim',
        'penerima',
        'perihal',
        'token_lampiran',
        'dibaca',
        'disposisi',
        'id_user',
        'tgl_sm',
        'isi',
        'id_pengirim',
        'id_penerima'
    ];

}
