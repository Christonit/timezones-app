<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProjectsGroup;

class Clients extends Model
{
    //
    protected $table = 'clients';
    protected $fillable = ['name','timezone','teams_id'];
    protected $guarded = [];

    protected function list(){
        return $this->belongsTo(ProjectsGroup::class);
    }
}
