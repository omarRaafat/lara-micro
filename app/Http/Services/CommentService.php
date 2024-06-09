<?php 

namespace App\Http\Services;

use App\Models\Post;
use App\Models\User;
use App\Traits\HandleResponse;
use App\Traits\uploadFile;
use Illuminate\Support\Arr;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\PostRepository;

class CommentService {

    use HandleResponse;
   

    public function __construct(public PostRepository $postRepository){}
   
    public function getPostComments($post){
        
        return $this->postRepository->getPostComments($post);
      
    }

    public function createPostComment($request){
        
      return
        $this->handelResponse(
            201,
            $this->postRepository->createPostComment($request),
            'Comment created successfully'
           
        );
     
    }


}