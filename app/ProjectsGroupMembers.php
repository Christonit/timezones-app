<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TeamMembers;

class ProjectsGroupMembers extends Model
{
    //
    protected $table = 'project_members';
    protected $fillable = ['projects_id','team_members_id','clients_id'];
    protected $guarded = [];

    protected function integrants(){
        // return "hola";
        return $this->hasMany(TeamMembers::class);
    }

   

}
