<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status_id',
        'budget',
        'start_date',
        'end_date',
        'description',
        'user_id',
        'client_id',
    ];

    public function scopeFilter($query, array $filters) {
        if($filters['search_projects'] ?? false) {
            $query->where('title', 'like', '%' . request('search_projects') . '%')
                ->orWhere('status', 'like', '%' . request('search_projects') . '%');
        }
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function status() {
        return $this->belongsTo(Status::class,);
    }

    public function getresult()
    {
        return substr($this->title, 0, 100);
    }

    public function getlink()
    {
        return str('/projects/information/'.$this->id);
    }
}
