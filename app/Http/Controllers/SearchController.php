<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TeamMembers;
use App\ProjectsGroup;

class SearchController extends Controller
{
    //

    public function searchbar(Request $request){
        $q = $request->q;
        $id = $request->team;

        $results = collect([]);

        $by_timezone_abbr = TeamMembers::where('teams_id',$id)->where('timezone_abbr','LIKE','%'.$q.'%')
        ->limit(3)->pluck('timezone_abbr')->unique();

        $by_timezone = TeamMembers::where('teams_id',$id)->where('timezone','LIKE','%'.$q.'%')
        ->limit(3)->pluck('timezone')->unique();

        $by_name = TeamMembers::where('teams_id',$id)->where('name','LIKE','%'.$q.'%')
        ->limit(3)->pluck('name')->unique();

        $by_project = ProjectsGroup::where('teams_id',$id)->where('name','LIKE','%'.$q.'%')
        ->limit(3)->pluck('name')->unique();

        foreach ($by_project as $key => $project) {
            $projects['value'] = $project;
            $projects['key'] = 'project';
            $by_project[$key] = $projects;
        }

        foreach ($by_name as $key => $name) {
            $names['value'] = $name;
            $names['key'] = 'name';
            $by_name[$key] = $names;
        }

        foreach ($by_timezone as $key => $timezone) {
            $timezones['value'] = $timezone;
            $timezones['key'] = 'timezone';
            $by_timezone[$key] = $timezones;
        }

        foreach($by_timezone_abbr as $key => $abbr){
            $timezones_abr['value'] = $abbr;
            $timezones_abr['key'] = 'abbr';
            $by_timezone_abbr[$key] = $timezones_abr;
        }

        $results = $results->concat($by_project)->concat($by_timezone_abbr)->concat($by_timezone)->concat($by_name);

        return $results->shuffle();

    }

    
}
