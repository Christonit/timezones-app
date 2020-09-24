<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectsGroup extends Model
{
    //
    protected $table = 'projects';
    protected $fillable = ['name','teams_id'];

}
