<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiMingguan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'nilai_harian_pengampu';
    protected $primaryKey = 'nilai_pengampu_id';

    protected $fillable = 
    [
        'nilai_pengampu_id',
        'kode_mata_kuliah',
        'nim',
        'minggu',
        'project_id',
        'aspek_id',
        'nilai_aspek'
        
    ];

}
