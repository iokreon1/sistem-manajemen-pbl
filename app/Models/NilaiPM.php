<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPM extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'nilai_pm';
    protected $primaryKey = 'nilai_pm_id';

    protected $fillable =
        [
            'nilai_pm_id',
            'nim',
            'project_id',
            'aspek_id',
            'nilai_aspek'

        ];

    public function aspekPenilaianPM()
    {
        return $this->belongsTo(AspekPenilaianPM::class, 'aspek_id', 'aspek_id');
    }



         
        
    

}
