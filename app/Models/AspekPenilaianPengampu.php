<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspekPenilaianPengampu extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'aspek_penilaian_pengampu';
    protected $primaryKey = 'aspek_id';

    protected $fillable = 
    [
        'aspek_id',
        'nama_aspek'
    ];
}
