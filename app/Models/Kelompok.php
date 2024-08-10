<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

     public $timestamps = false;

    protected $table = 'kelompok';
    protected $primaryKey = 'kelompok_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'nim',
        'project_id',
        'ketua_kelompok'
    ];

    protected $casts = [
        'nim' => 'string',
    ];

    public function projects()
    {
        return $this->belongsTo(Projects::class, 'project_id', 'project_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'kelompok', 'kelompok_id', 'nim')
                ->withPivot('ketua_kelompok');
    }

} 
