<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timezones extends Model
{
    //
    protected $fillable = ['name','abbreviation','iana_time_zone_id','utc_offset'];
    
}
