<?php 


namespace App\Http\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentsResource;
use App\Http\Repositories\BaseRepository;
use App\Exceptions\CustomModelNotFoundException;
// use App\Http\Collections\postCommentaCollection;
use App\Http\Collections\postCommentsCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostRepository extends BaseRepository
{


    public function model(): string{
        return Post::class;
    }


    public function getPosts(){

        return $this->model->where('user_id',Auth::user()->id)->get();
        
    }


    
    public function showPost($post){
        return $this->model->whereUserId(Auth::user()->id)->whereId($post->id)->first();
    }

    
    public function deletePost($post){
       
      
        $post = $this->model->whereUserId(Auth::user()->id)->whereId($post)->first();
        if(!$post)
            throw new CustomModelNotFoundException('no post found with this id' , 404);
       
      
       
    }

    
    public function updatePosts(){
        
    }


    public function storePost($data , $user_id){
        return $this->model
        ->updateOrCreate([
            'body' => $data['body'],
            'user_id' => $user_id
        ]);
    }



    public function getPostComments($post){
        $post = $this->model->find($post);
        if(!$post)
            throw new CustomModelNotFoundException('no post found with this id to get Comments' , 404);
        return $post->comments()->get();
    }

    public function createPostComment($data){
        $post =  $this->model->find($data['post_id']);
        if(!$post)
            throw new CustomModelNotFoundException('no post found wirth this id' , 404);
         $post->comments()->create([
            'comment' => $data['comment'],
            'author_id' => Auth::user()->id
        ]);
        
        return new postCommentsCollection($post->comments()->paginate(3));
    }



}



?>