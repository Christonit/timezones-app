<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\TeamMembers;
use App\ProjectsGroup;

class Teams extends Model
{
    //
    protected $fillable = ["name","owner"];

    protected function getTeams(){
        return $this->where('owner_id', Auth::id());
    }

    protected function listTeams(){
        return $this->where('owner_id', Auth::id())->get(['id','name']);
    }

    public function teamMembers(){
        return $this->hasMany(TeamMembers::class);
    }
    
    public function projectsGroup(){
        return $this->hasMany(ProjectsGroup::class);
    }

    
}
