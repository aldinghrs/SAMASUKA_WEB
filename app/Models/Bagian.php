<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    use HasFactory;
    protected $table = 'tbl_bagian';
    protected $primaryKey = 'id_bagian';
    protected $fillable = ['nama_bagian', 'id_user'];
    protected $casts = [
        'id_bagian' => 'int',
        'id_user' => 'int'
    ];
}
