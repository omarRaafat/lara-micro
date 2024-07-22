<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Test;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\ImageValidation;
use Illuminate\Support\Facades\Storage;
use App\Http\Services\ImageHandlerService;

class ImageController extends Controller
{

    public function index(){
        return view('tests');
    }
    public function proccess(Request $request){

        $file = collect($request->file('files'))->first();
        $path = $file->storeAs(uniqid('tmp/') , $file->getClientOriginalName(), 'local');
        return response()->json($path);
    }

    public function revert(Request $request){

        $path = json_decode($request->getContent());
        $directory = pathinfo($path,PATHINFO_DIRNAME);
        Storage::disk('local')->deleteDirectory($directory);
        return response()->json();
    }

    public function restore (Request $request){
        $path = json_decode($request->input('path'));
        $file  = Storage::disk('local')->get($path);
        $filename = basename($path);
        return response()->make($file)->withHeaders([
            'Content-Disposition' => "inline; filename=\"$filename\"",
        ]);
    }

    public function store(Request $request){
        if(!$request->input('files'))
            return redirect()->back()->with([
                'error' => 'No Media File Inserted'
            ]);
        $test = Test::query()->create();

        foreach($request->input('files') as $file){
    
            $filePath = storage_path('app/'. json_decode($file));
         
            $test->addMedia($filePath)->toMediaCollection();

            Storage::disk('local')->deleteDirectory(pathinfo($filePath , PATHINFO_DIRNAME));
        }
    
        return back()->with('forceClearCache' , true);
    }

    public function resize(Request $request , ImageHandlerService $imageHandlerService)
    {
        return $imageHandlerService->upload($request->image);
    }

  
}
