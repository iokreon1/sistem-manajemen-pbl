<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPengampu extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'dosen_pengampu';
    protected $primaryKey = 'id_dosen_pengampu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable =
    [
        'id_dosen_pengampu',
        'project_id',
        'nip',
        'kode_mata_kuliah'
    ];

    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nip', 'nip');
    }

    public function mataKuliah() {
        return $this->belongsTo(MataKuliah::class, 'kode_mata_kuliah', 'kode_mata_kuliah');
    }
}
