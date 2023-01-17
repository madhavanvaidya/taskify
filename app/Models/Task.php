<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'project_id',
        'start_date',
        'due_date',
        'description',
        'user_id',
    ];

    public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
