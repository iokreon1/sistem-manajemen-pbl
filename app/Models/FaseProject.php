<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaseProject extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'fase_project';
    protected $primaryKey = 'fase_id';

    protected $fillable = 
    [
        'fase_id',
        'nama_fase',
        
    ];
}
