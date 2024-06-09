<?php 

namespace App\Http\Services;

use App\Models\City;
use App\Models\User;
use App\Traits\uploadFile;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AreasResource;
use App\Http\Resources\PostsResource;
use App\Http\Collections\UsersCollection;
use App\Http\Repositories\AreaRepository;
use App\Http\Repositories\UserRepository;

class AreaService {


    function __construct(public AreaRepository $areaRepository){}


    public function getAreas(){
        return AreasResource::collection($this->areaRepository->all()
                ->newQuery()->get()
                ->load('city')
        )
                ;
    }

    public function storeArea($data){
        return AreasResource::make($this->areaRepository->all()->newQuery()
        ->create([
            'name' => $data['name'],
            'city_id' => $data['city_id']
        ])
        );
    }

    public function getAreaWarehouses($data){
        return AreasResource::make(
            $this->areaRepository->all()->newQuery()
                ->findOrFail($data['area_id'])
                ->load('warehouses.warehouse')
        );

    }


  

}