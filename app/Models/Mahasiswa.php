<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'nim',
        'nama_lengkap',
        'prodi_id'
    ];

        /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'nim' => 'string',
    ];
    
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'nim', 'nim');
    }
    
    public function projects()
    {
        return $this->belongsToMany(Projects::class, 'mahasiswa_project', 'nim', 'project_id');
    }
    
    public function kelompoks()
    {
        return $this->belongsToMany(Kelompok::class, 'kelompok', 'nim', 'nim')
                    ->withPivot('ketua_kelompok');
    } 

    
} 
