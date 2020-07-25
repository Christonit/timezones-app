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

        $user['avatar'] =  $user['avatar'] == null ? null : asset('/storage/'.$user->avatar);
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

        if($request->has('start_hour') && $request->start_hour != Auth::user()->start_hour ){
            $user->start_hour = $request->input('start_hour');
        }

        if($request->has('end_hour') && $request->end_hour != Auth::user()->end_hour ){
            $user->end_hour = $request->input('end_hour');
        }

        if( $request->has('timezone') && ($request->timezone != Auth::user()->timezone || $request->timezone_abbr != Auth::user()->timezone_abbr) ){
            $user->timezone = $request->input('timezone');
            $user->timezone_abbr = $request->input('timezone_abbr');
        }

        if( $request->hasFile('avatar') && $request->file('avatar')->isValid() ){
            $user->avatar = $request->file('avatar')->store("avatars");
        }

        $user->save();

        return $user;

    }
}
