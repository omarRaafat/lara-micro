<?php

namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



trait uploadFile {

    public function upload($user){

        // maunal way to upload
        // $file_name = Str::random(5).'-'.$file->getClientOriginalName();
        // Storage::disk('local')->put('public/'.$path.'/'.$file_name,file_get_contents($file));
        // return $file_name;

        // automatic way to upload
        $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        return $user->profile_image;

    }


}