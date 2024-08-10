<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiUjian extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'nilai_ujian';

    protected $fillable = 
    [
        'nim',
        'kode_mata_kuliah',
        'project_id',
        'tipe_ujian',
        'aspek_id',
        'nilai_aspek'
        
    ];

}
