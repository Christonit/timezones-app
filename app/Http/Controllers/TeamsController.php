<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Teams;
use App\Clients;
use App\Projects;
use App\TeamMembers;
use App\ProjectsGroupMembers;

class TeamsController extends Controller
{
    //
    public function teams(){

        return Teams::find(1)->teamMembers;

    }

    public function create(Request $request){

        $new_team = new Teams;
        $new_team->name = $request->name;
        $new_team->owner_id = Auth::id();

        return $new_team->save();
    }

    public function list(){

        return Teams::listTeams();
    }

    public function edit(Request $request){

        $team = Teams::find($request->id);
        $team->name = $request->name;

        return $team->save();
    }
    public function destroy($id){

        return Teams::destroy($id);
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
                $team->teams_id = $request->team['id'];
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
        $projects = Teams::find($team)->projectsGroup;

        $projects = $projects->pluck('id');

        $clients = [];
        $client_list = collect([]);
       
        foreach ($projects as $key => $id) {
            $clients[] = Clients::where('project_id', $id)->get(['id','name','timezone']);
        }
        foreach ($clients as $key => $client) {
            $client_list = $client_list->concat($client);
        }


        $client_list = $client_list->unique('name');

        foreach ($client_list as $key => $client) {
            $client['member_type'] = 'client';
        }

        $team_members = TeamMembers::where('teams_id',$team)->get();
        foreach($team_members as $member){

            $member['avatar'] = ($member['avatar'] == null) ? null : asset('/storage/'.$member->avatar);
            $member['member_type'] = 'teammate';
        }

        return collect($team_members)->concat($client_list);

    }

    public function getTeammate(Request $request){

        if($request->has('id')){

            if($request->has('user') && $request->user === true ){
                $user =  User::findOrFail($request->id);
                $user['avatar'] = $user['avatar'] == null ? null : asset('/storage/'.$user->avatar);

                return $user;
            }
            $teammate = TeamMembers::findOrFail($request->id);
            $teammate['avatar'] = $teammate['avatar'] == null ? null : asset('/storage/'.$teammate->avatar);
            $teammate['member_type'] = "teammate";

            return $teammate;

        }else{

            return response('bad-parameters')->setStatusCode(400);

        }

    }

    protected function destroyTeamMember($id){
        $presence_in_projects = ProjectsGroupMembers::where('team_members_id',$id)->pluck('id');

        if($presence_in_projects->count() > 0){
            foreach ($presence_in_projects as $teammate) {
                ProjectsGroupMembers::destroy($teammate);
            }
        }

        return TeamMembers::destroy($id);
        
    }

    protected function allProjectGroups(Request $request, $name){
        $id = $request->id;
        
        return Teams::where('owner_id',Auth::id())->find($id)->projectsGroup;
    }
   
    
}
