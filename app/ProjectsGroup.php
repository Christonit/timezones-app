<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Teams;
use App\Clients;

class ProjectsGroup extends Model
{
    //
    protected $table = 'projects';
    protected $fillable = ['name','teams_id'];

    public function team(){
        return $this->belongsTo(Teams::class);
    }

    // public function clients(){
    //     return $this->hasMany(Clients::class);
    // }

}
