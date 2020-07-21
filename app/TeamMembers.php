<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMembers extends Model
{
    //
    protected $table = 'team_members';

    protected $fillable = ['team','name','email','timezone','start_hour','end_hour','is_activated','invited'];

}
