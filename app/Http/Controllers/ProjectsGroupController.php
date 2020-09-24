<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectsGroup;
use App\Clients;
use App\ProjectsGroupMembers;
use Illuminate\Support\Facades\Auth;

class ProjectsGroupController extends Controller
{
    //
    public function createGroup(Request $request, $team){
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
                $client->timezone = $new_client['timezone']['id'];
                $client->project_id = $project_group_id;

                $client->save();
                ProjectsGroupMembers::create([
                    'projects_id'=> $project_group_id,
                    'clients_id'=> $client->id
                ]);
            }

        };

        return response('confirmed',200);

    }

}
