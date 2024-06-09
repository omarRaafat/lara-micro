<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController as UserController;
class DemoController extends Controller
{
    public function demo(Request $request){
        // return User::all();
       
        // return $request->ip();
        // return  $_ENV;
      
        
        $time = Carbon::now('Africa/cairo')->format('g:i A');

        // return $time;

      

        $tmdb_id = $request->movieId?? 10200; //Black Adam (2022) Movie TMDB ID

        $data = Http::asJson()
            ->get(config('services.tmdb.endpoint').'movie/'.$tmdb_id. '?api_key='.config('services.tmdb.api'));
            // return $data->json();
            notify()->success('Welcome to Laravel Notify ⚡️');
            // Http::post('http://localhost:88/laraMicro/public/api/send-sms' , [
            //     'phone' => '+201066343688',
            //     'message' => 'Day Movie Is : '.$data['title']
            //  ]);
            // return redirect()->action(UserController::class,'index');
        return view('demo',compact('data'));
    }
}
