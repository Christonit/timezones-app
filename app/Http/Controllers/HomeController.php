<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\User;
use App\TeamMembers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // Auth::logout();
        return view('index');
    }

    public function getUser(){
        $user = Auth::user();

        $user['avatar'] = asset('/storage/'.$user->avatar);
        return $user;
    }

    public function updateUser(Request $request){
        
        if($request->has("teammate") ){

            $user = TeamMembers::find($request->teammate);

        }else{
            $user_id = Auth::id();    
            $user = User::find($user_id);
        }


        if($request->has('name') && $request->name != Auth::user()->name){
            $user->name = $request->input('name');
        }
        if($request->has('start_hour')){
            $user->start_hour = $request->input('start_hour');
        }

        if($request->has('end_hour')){
            $user->end_hour = $request->input('end_hour');
        }

        if( $request->has('timezone')){
            $user->timezone = $request->input('timezone');
            $user->timezone_abbr = $request->input('timezone_abbr');
        }

        if( $request->hasFile('avatar') && $request->file('avatar')->isValid() ){
            $user->avatar = $request->file('avatar')->store("avatars");
        }

        return $user->save();

    }
}
