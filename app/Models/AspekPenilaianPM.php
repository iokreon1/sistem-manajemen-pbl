<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspekPenilaianPM extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'aspek_penilaian_pm';
    protected $primaryKey = 'aspek_id';

    protected $fillable =
        [
            'aspek_id',
            'nama_aspek',
            'fase_id'

        ];

    public function faseProject()
    {
        return $this->belongsTo(FaseProject::class, 'fase_id', 'fase_id');

    }
}

