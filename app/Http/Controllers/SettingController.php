<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Services\SettingsService;

class SettingController extends Controller
{
    function __construct(public SettingsService $settingsService){}
    
    public function index(){
       
        return settings();
    }
}
