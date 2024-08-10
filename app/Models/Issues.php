<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    use HasFactory;

    protected $table = 'issues';
    protected $primaryKey = 'issue_id';
    

    protected $fillable =
    [
        'issue_id',
        'nama_issue',
        'deadline_issue',
        'milestone_id',
        'start_issue',
        'status'
    ];

    public $timestamps = false;
    public function milestone()
    {
        return $this->belongsTo(Milestone::class, 'milestone_id', 'milestone_id');
    }
}
