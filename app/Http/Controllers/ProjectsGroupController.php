<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectsGroup;
use App\Clients;
use App\ProjectsGroupMembers;
use App\TeamMembers;
use Illuminate\Support\Facades\Auth;

class ProjectsGroupController extends Controller
{
    //
    public function ownerTeam(){
        return ProjectsGroup::find(14)->team;
    }

    public function membersOfGroup(Request $request){
        $project_id = $request->id;
        #Exits execution of script if url has both only_clients and only_teammates
        if($request->only_clients == true && $request->only_teammates == true){
            return response('invalid request', 404);
        }

        //Gets all projects clients.
        $clients = Clients::where('project_id',$project_id)->get(['id','name','timezone']);        ;
        $clients_updated = [];
        foreach ($clients as $key => $client) {
            # code...
            $client['member_type'] = 'client';
            $clients_updated[] = $client;
        }
        #returns only clients
        if($request->only_clients == true){
            return $clients_updated;
        }

        //Gets all projects teammates
        $project_members_ids = ProjectsGroupMembers::where('projects_id',$project_id)->get(['team_members_id']);
        $teammates = [];
        foreach ($project_members_ids as $key => $id) {
            $team_id = $id['team_members_id'];

            if($team_id != null){
                $teammate = TeamMembers::where('id',$team_id)->get(['id','name','email','start_hour','end_hour','timezone','timezone_abbr','avatar']);
                $teammate[0]['member_type'] = "teammate";
                $teammates[] = $teammate[0];
            }
        }
        
        #return only teammates
        if($request->only_teammates == true){
            return $teammates;
        }

        return array_merge($teammates,$clients_updated);

    }

    public function changeName(Request $request, ProjectsGroup $project){

        try{
        
            $project->name = $request->name;
            $project->save();

            return response($project,200);

        }catch( Exception $e){
            return response('Rrror in projects group creation', 500);
        }
    }
    public function destroy(Request $request, $project){

        try{
            ProjectsGroupMembers::where("projects_id", $project)->delete();
        
            ProjectsGroup::where("id", $project)->where("teams_id", $request->team_id)->delete();

            return response("success",200);

        }catch( Exception $e){
            return response('Rrror in projects group creation', 500);
        }
    }

    public function createGroup(Request $request, $team){
        try{

            #Creates a new project group category
            $project_group = new ProjectsGroup;
            $project_group->name = $request->name;
            $project_group->teams_id = $team;
            $project_group->created_by_id = Auth::id();
            $project_group->save();
            $project_group_id = $project_group->id;

            #Adds teammates to project group category;
            if(count($request->teammates) > 0){
                foreach ($request->teammates as $key => $teammate) {
                    ProjectsGroupMembers::create([
                        'projects_id'=> $project_group_id,
                        'team_members_id'=> $teammate
                    ]);
                }
            }

            # Run this code if payload has any clients
            if($request->has('clients') && count($request->clients) > 0 ){
                foreach ($request->clients as $key => $new_client) {
                    $client = new Clients;            
                    $client->name = $new_client['name'];
                    $client->timezone = $new_client['timezone'];
                    $client->project_id = $project_group_id;
                    $client->save();
                    ProjectsGroupMembers::create([
                        'projects_id'=> $project_group_id,
                        'clients_id'=> $client->id
                    ]);
                }

            };

            return response($project_group,200);

        }catch( Exception $e){
            return response('Rrror in projects group creation', 500);
        }
        

    }
    
    public function updateGroup(Request $request, $project){
        try{

            #Creates a new project group category
            $teammate_to_remove = null;
            $client_to_remove = [];
            $clients = null;

            #Members to remove.
            if( count($request->teammates) > 0 ){
                $teammate_to_remove = collect($request->og_teammates)->diff($request->teammates);
                if(count($teammate_to_remove) > 0){

                    foreach ($teammate_to_remove as $key => $pal) {
                        ProjectsGroupMembers::where('projects_id', $project)
                        ->where('team_members_id', $pal )->delete();
                        # code...
                    }
                }
            }

            #Adds teammates to project group category;

            if(count($request->teammates) > 0){
                foreach ($request->teammates as $key => $teammate) {
                    ProjectsGroupMembers::firstOrCreate([
                        'team_members_id'=> $teammate,
                        'projects_id'=> $project                        
                    ]);
                }
            }          

            
            if( is_array($request->og_clients) && count($request->og_clients) > 0 ){
                
                $clients = $request->og_clients;

                foreach ($clients as $key => $client) {

                    ProjectsGroupMembers::where('projects_id', $project)
                    ->where('clients_id', $client['id'] )->delete();

                    Clients::find($client['id'])->delete();

                }
            }

            # Run this code if payload has any clients
            if(is_array($request->clients) && count($request->clients) > 0 ){
                foreach ($request->clients as $key => $new_client) {
                    $timezone_id = $new_client['timezone'];

                    $client = new Clients;            
                    $client->name = $new_client['name'];
                    $client->timezone = is_array($timezone_id) ? $timezone_id['id'] : $timezone_id;
                    $client->project_id = $project;
                    $client->save();
                    
                    ProjectsGroupMembers::create([
                        'projects_id'=> $project,
                        'clients_id'=> $client->id
                    ]);
                }

            };

            return response($project,200);

        }catch( Exception $e){
            return response('Rrror in projects group creation', 500);
        }
        

    }



}
