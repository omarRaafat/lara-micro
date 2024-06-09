<?php 

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;



function setTextToLower($string){

    return Str::upper($string);
}


if(!function_exists('settings')){
        
    function settings(){
        return Cache::get('settings');
    }
}