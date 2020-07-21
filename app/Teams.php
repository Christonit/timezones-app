<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Teams extends Model
{
    //
    protected $fillable = ["name","owner"];

    protected function getTeams(){
        return $this->where('owner', Auth::id());
    }

    protected function listTeams(){
        return $this->where('owner', Auth::id())->get(['id','name']);
    }
    
}
