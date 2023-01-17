<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'budget',
        'start_date',
        'end_date',
        'description',
        'user_id',
        'client_id',
    ];

    public function tasks() {
        return $this->hasMany(Task::class, 'project_id');
    }
}
