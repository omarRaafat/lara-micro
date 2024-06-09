<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Traits\HandleResponse;
use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;

class PostController extends Controller
{
    use HandleResponse;

    function __construct(public PostService $postService){
        
    }
    
    public function index(){

        return $this->postService->getUserPosts();
    }

    public function store(PostRequest $postRequest){
       
        return $this->handelResponse(
            201,
            $this->postService->storePost($postRequest),
            null
        );
    }  

    public function show(Post $post){
        return $this->postService->getPost($post);
    }

    public function destroy($post){
        if($this->postService->deletePost($post)){
            return $this->handelResponse(
                200,
                [],
                'Post deleted successfully'
            );
        }
           
    }
}
