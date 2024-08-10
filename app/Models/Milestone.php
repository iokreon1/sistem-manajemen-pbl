<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $table = 'milestones';
    protected $primaryKey = 'milestone_id';

    protected $fillable = 
    [
        'milestone_id',
        'nama_milestone',
        'deskripsi',
        'deadline',
        'project_id',
        'status'
    ];

    public $timestamps = false;
    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id', 'project_id');
    }

    public function issues()
    {
        return $this->hasMany(Issues::class, 'milestone_id', 'milestone_id');
    }

    public function getProgressAttribute()
    {
        $totalIssues = $this->issues()->count();
        $completedIssues = $this->issues()->where('status', true)->count();
    
        $progress = $totalIssues > 0 ? ($completedIssues / $totalIssues) * 100 : 0;
    
        return round($progress);
    }
    
}
