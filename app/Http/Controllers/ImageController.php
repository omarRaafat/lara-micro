<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageValidation;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Services\ImageHandlerService;
use App\Models\Post;

class ImageController extends Controller
{
    public function resize(Request $request , ImageHandlerService $imageHandlerService)
    {
        return $imageHandlerService->upload($request->image);
    }

    public function store(ImageValidation $request)
    {

        
     
        $user  = User::find(1);
       

        if ($request->hasFile('profile_image')) {
            $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        }


        return $user->getMedia('profile_image');
    }
}
