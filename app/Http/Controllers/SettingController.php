<?php

namespace App\Http\Controllers;

use App\Traits\HandleResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Services\SettingsService;
use Settings; // FACADES PATTERN
class SettingController extends Controller
{
    use HandleResponse;
    
    public function index(){
       return $this->handelResponse(
        200,
        Settings::getSettings(), // FACADES PATTERN
        null
       );
    
    }

    public function setSettings(Request $request){
         Settings::setSettings($request); // FACADES PATTERN
         return $this->handelResponse(
            201,
            [],
            'settings setted'
         );
    }
}
