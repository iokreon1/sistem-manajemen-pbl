<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'projects';
    protected $primaryKey = 'project_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'desain_umum', 
        'judul_project', 
        'nip',
        'tipe_pendanaan', 
        'kode_pbl', 
        'waktu_pengerjaan', 
        'semester', 
        'jenis_usulan', 
        'tahun_akademik'
    ];

    public function dosen(){
        return  $this->hasOne(Dosen::class,'nip','nip');
    }

    public function kelompok(){
        return  $this->hasMany(Kelompok::class,'project_id','project_id');
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'kelompok', 'project_id', 'nim');
    }
    
    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_project', 'project_id', 'nim');
    }
    
    public function waktu()
    {
        return $this->hasOne(Waktu::class, 'project_id');
    }

    public function projects()
    {
        return $this->hasMany(Projects::class);
    }

    public function dosenPengampu()
    {
        return $this->hasMany(DosenPengampu::class, 'project_id','project_id');
    }

    public function mataKuliah()
    {
        return $this->hasManyThrough(MataKuliah::class, DosenPengampu::class, 'project_id', 'nip', 'project_id', 'kode_mata_kuliah');
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class, 'project_id', 'project_id');
    }

    public function issues()
    {
        return $this->hasManyThrough(Issues::class, Milestone::class, 'project_id', 'milestone_id', 'project_id', 'milestone_id');
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function overallProgress()
{
    $totalIssuesCount = $this->issues()->count();
    $completedIssuesCount = $this->issues()->where('status', true)->count();

    return $totalIssuesCount > 0 ? ($completedIssuesCount / $totalIssuesCount) * 100 : 0;
}


}