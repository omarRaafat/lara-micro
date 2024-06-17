<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\FileBag;

class TestController extends Controller
{
    public function index(){
        return view('tests');
    }
    public function upload(Request $request){

        $path = collect($request->file('files'))->first()->store('tmp' , 'local');
        return response()->json($path);
    }

    public function revert(Request $request){

        Storage::disk('local')->delete(json_decode($request->getContent()));
        return response()->json();
    }

    public function store(Request $request){
        $test = Test::query()->create();

        foreach($request->input('files') as $file){
    
            $filePath = storage_path('app/'. json_decode($file));
         
            $test->addMedia($filePath)->toMediaCollection();
        }
    
        return back();
    }
}
