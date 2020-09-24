<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectsGroupMembers extends Model
{
    //
    protected $table = 'project_members';
    protected $fillable = ['projects_id','team_members_id','clients_id'];
    protected $guarded = [];

}
