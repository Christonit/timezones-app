<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Timezones;

class TimezonesController extends Controller
{
    //
    protected function upload(Request $request){
        // return $request;

        return Timezones::create($request->all());
    }

    protected function search_timezone(Request $request){

        
        $text = $request->input('search');

        $text_lenght = strlen($text);
        $split = str_split($text);

        $timezones = array();
        
        if($split[0] == "U"){
            $list = DB::select("SELECT `name`,`iana_time_zone_id`,`utc_offset` FROM `timezones` WHERE LEFT(`name`,".$text_lenght.") = '".$text."' ");
            
            foreach ($list as $timezone) {

                $timezones[] = ['name' => $timezone->name,
                'utc_offset' => $timezone->utc_offset,
                'id' => $timezone->iana_time_zone_id];

            }        

        }else{

            $list = DB::select("SELECT `name`,`abbreviation`,`iana_time_zone_id`,`utc_offset` FROM `timezones` WHERE LEFT(`abbreviation`,".$text_lenght.") = '".$text."' ");
            foreach ($list as $timezone) {
                $timezones[] = ['name' => $timezone->abbreviation.' - '.$timezone->name,
                'utc_offset' => $timezone->utc_offset,
                'id' => $timezone->iana_time_zone_id];
            }
        }


        return $timezones;

    }
}
