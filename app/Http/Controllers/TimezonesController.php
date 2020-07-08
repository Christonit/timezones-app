<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timezones;

class TimezonesController extends Controller
{
    //
    protected function upload(Request $request){
        // return $request;

        return Timezones::create($request->all());
    }
}
