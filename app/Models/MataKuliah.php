<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'mata_kuliah';
    protected $primaryKey = 'kode_mata_kuliah';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'kode_mata_kuliah',
        'nama_matakuliah',
        'nip'
        
    ];

    protected $casts = [
        'kode_mata_kuliah' => 'string',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nip', 'nip');
    }

    public function dosenPengampu()
    {
        return $this->hasMany(DosenPengampu::class, 'kode_mata_kuliah', 'nip');
    }
}

