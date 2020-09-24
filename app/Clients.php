<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    //
    protected $table = 'clients';
    protected $fillable = ['name','timezone','teams_id'];
    protected $guarded = [];
}
