<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'password_confirmation',
        'phone',
        'company', 
        'address',
        'city',
        'state',
        'country',
        'zip',
        'profile'
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function getresult()
    {
        return str($this->first_name." ".$this->last_name);
    }

    public function getlink()
    {
        return str('/clients/profile/show/'.$this->id);
    }
}
