<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TeamMembers;
use App\ProjectsGroup;
use App\ProjectsGroupMembers;

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
            $timezones_abbr['value'] = $abbr;
            $timezones_abbr['key'] = 'abbr';
            $by_timezone_abbr[$key] = $timezones_abbr;
        }

        $results = $results->concat($by_project)->concat($by_timezone_abbr)->concat($by_timezone)->concat($by_name);

        return $results->shuffle();

    }


    //Function for searchbar query
    public function searchQuery(Request $request){

        $names = $request->names;
        $timezones = $request->timezones;
        $timezones_abbr = $request->timezone_abbr;
        $groups = $request->groups;

        $teammembers = null;

        //Search Names only
        if(sizeof($names) > 0 && 
            (sizeof($timezones) == 0 && sizeof($timezones_abbr) == 0 && sizeof($groups) == 0)){
            $teammembers = TeamMembers::whereIn('name',$names)->get(); 
        }
        
        //Search by Names and timezones
        if((sizeof($names) > 0 && sizeof($timezones) > 0) && 
            (sizeof($timezones_abbr) == 0 && sizeof($groups) == 0)){

            $teammembers =  TeamMembers::whereIn('name',$names)
               ->whereIn('timezone',$timezones)->get(); 
        }

        //Search by Names and timezones abbr
        if((sizeof($names) > 0 && sizeof($timezones_abbr) > 0) && 
            (sizeof($timezones) == 0 && sizeof($groups) == 0)){

            $teammembers =  TeamMembers::whereIn('name',$names)
               ->whereIn('timezone_abbr',$timezones_abbr)->get(); 
        }

        //Search by Names, timezones_Abbr and timezones
        if((sizeof($names) > 0 && sizeof($timezones) > 0 && sizeof($timezones_abbr) > 0)){
                // return 'xxx';
            $teammembers =  TeamMembers::whereIn('name',$names)
               ->whereIn('timezone',$timezones)
               ->whereIn('timezone_abbr',$timezones_abbr)->get(); 
        }

        // Search by timezones_Abbr and timezones
        if((sizeof($timezones) > 0 && sizeof($timezones_abbr) > 0) &&
            (sizeof($names) == 0)){

            $teammembers =  TeamMembers::whereIn('timezone',$timezones)
               ->whereIn('timezone_abbr',$timezones_abbr)->get(); 
        }

        // Search by Timezones
        if( sizeof($timezones) > 0 &&
            (sizeof($names) == 0) && sizeof($timezones_abbr) == 0){
            $teammembers =  TeamMembers::whereIn('timezone',$timezones)->get(); 
        }

        // Search by timezones_Abbr
        if( sizeof($timezones_abbr) > 0 &&
            (sizeof($names) == 0) && sizeof($timezones) == 0){

            $teammembers =  TeamMembers::whereIn('timezone_abbr',$timezones_abbr)->get(); 
        }

        //Executes it if in the query there are any groups
        if( sizeof($groups) > 0 ){
            
            $team_id = $teammembers[0]->teams_id;
            $groups = ProjectsGroup::whereIn('name',$groups)->where('teams_id',$team_id)->pluck('id');
            
            //Currently prints just teammates id
            $project_members = ProjectsGroupMembers::whereIn('projects_id',$groups)->pluck('team_members_id');
            
            //Returns matching  teammembers in a group
            return $teammembers->find($project_members);
        }

        

    }

    
}
