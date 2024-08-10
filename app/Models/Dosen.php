<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'dosen';
    protected $primaryKey = 'nip';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'id_user',
        'nip',
        'nama_dosen'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'nip' => 'string',
    ];

    public function mata_kuliah()
    {
        return $this->hasMany(MataKuliah::class, 'nip', 'nip');
    }
} 
