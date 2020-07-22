<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Teams;
use App\TeamMembers;

class TeamsController extends Controller
{
    //
    public function create(Request $request){

        $new_team = new Teams;
        $new_team->name = $request->name;
        $new_team->owner = Auth::id();

        return $new_team->save();
    }

    public function list(){

        return Teams::listTeams();
    }

    public function latestCreated(){
        return Teams::getTeams()->latest()->first(['id','name']);
    }

    public function addMembers(Request $request){
        
        try{

            if( count($request->new_members) < 1 ){
               return response('no-member')->setStatusCode(199);
            };

            $counter = 0;
            foreach($request->new_members as $new_member){
                $counter++;
                $team = new TeamMembers;
                $team->team = $request->team['id'];
                $team->name = $new_member["name"];
                $team->email = $new_member["email"];
                $team->timezone = $new_member["timezone"]["id"];
                $team->timezone_abbr = $new_member["timezone"]["name"];
                $team->save();
            }

            return $counter;

        }catch(Throwable $e){
            return report($e);
        }
        
    }

    public function getTeamMembers($team){
        return TeamMembers::where('team',$team)->get();
    }

    public function getTeammate(Request $request){



        if($request->has('id')){
            // return TeamMembers::findOrFail(22);
            if($request->has('user') && $request->user === true ){
                return User::findOrFail($request->id);
            }
            return TeamMembers::findOrFail($request->id);

        }else{

            return response('bad-parameters')->setStatusCode(400);

        }

    }
   
    
}
