<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamManagers extends Model
{
    //
    protected $table = 'team_managers';

    protected $fillable = ['team','manager'];
    
}
