<?php 


namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\PostRepository;

class PostService{


    public function __construct(public PostRepository $postRepository){}

    public function getUserPosts(){
        return $this->postRepository->getPosts();
    }

    public function storePost($data){
        return $this->postRepository->storePost($data , Auth::user()->id);
    }

    public function getPost($post){

        return $this->postRepository->showPost($post);
    }

    public function deletePost($post){
        return $this->postRepository->deletePost($post);
    }


}



?>