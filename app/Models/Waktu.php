<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Projects;

class Waktu extends Model
{
    use HasFactory;
    protected $table = 'waktu';

    public $timestamps = false;

    protected $fillable = [
        'tanggal_mulai',
        'tanggal_akhir',
        'project_id', // pastikan nama kunci asing ini sesuai dengan yang ada di database Anda
    ];

    // Definisikan relasi dengan model proyek
    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }
}
