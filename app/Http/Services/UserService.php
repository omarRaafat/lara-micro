<?php 

namespace App\Http\Services;

use App\Models\User;
use App\Traits\uploadFile;
use Illuminate\Support\Arr;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\PostsResource;
use App\Http\Collections\UsersCollection;
use App\Http\Repositories\UserRepository;

class UserService {

    use uploadFile;

    function __construct(public UserRepository $userRepository){}

    public function getUsers($request){

        return new UsersCollection($this->userRepository->getUsers($request));
    }
   
    public function storeUser($payLoad)
     {
      
        $user = $this->userRepository->create($payLoad);
        $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        $user->profile_image = $user->media()->first();
      
        return UserResource::make($user);
    }


}