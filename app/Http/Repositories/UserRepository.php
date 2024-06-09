<?php 


namespace App\Http\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository  {


  
   

    public function model() : string{
        return User::class;
    }


    public function getUsers($request){

        return $this->model->active()->orderByRaw('created_at DESC , active ASC')->paginate($request->perPage);
    }

    public function create($payload){
       return $this->model->create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'password' => Hash::make($payload['password'])
        ]);
    }

}



?>