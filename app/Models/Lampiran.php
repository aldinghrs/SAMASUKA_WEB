<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    use HasFactory;
    protected $table = 'tbl_lampiran';
    protected $primaryKey = 'id_lampiran';
    protected $fillable = ['id_lampiran','token_lampiran', 'id_user'];
   
}
