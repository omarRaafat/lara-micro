<?php 


namespace App\Http\Repositories;
use App\Models\Area;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class WarehouseRepository extends BaseRepository  {


  
   

    public function model() : string{
        return Warehouse::class;
    }


   
}



?>