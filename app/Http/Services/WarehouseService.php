<?php 

namespace App\Http\Services;

use App\Exceptions\customModelNotFoundException;
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
use App\Http\Resources\WarehousesResource;
use App\Http\Repositories\WarehouseRepository;
use App\Models\Warehouse;

class WarehouseService {


    function __construct(public AreaRepository $areaRepository , public WarehouseRepository $warehouseRepository){}


    public function getAreas(){

        return AreasResource::collection($this->areaRepository->all()
                ->newQuery()->get()
                ->load('city')
        );
    }

    public function storeArea($data){
        return AreasResource::make($this->areaRepository->all()->newQuery()
        ->create([
            'name' => $data['name'],
            'city_id' => $data['city_id']
        ])
        );
    }

    public function createWarehouse($data){
        return WarehousesResource::make(
            $this->warehouseRepository->all()->create($data)
        );
    }

    public function updateWarehouse($data , $warehouse_id){
       
            $warehouse = $this->warehouseRepository->all()->newQuery()
                ->find($warehouse_id);
            if(!$warehouse)
                throw new customModelNotFoundException("no warehouse found with this id $warehouse_id" , 404);
            else    
                return $warehouse->update($data);
       
    }

    public function deleteWarehouse($warehouse_id){
       
        $warehouse = $this->warehouseRepository->all()->newQuery()
            ->find($warehouse_id);
        if(!$warehouse)
            throw new customModelNotFoundException("no warehouse found with this id $warehouse_id" , 404);
        else    
            return $warehouse->delete();
   
}

    public function getAreaWarehouses($data){
        return AreasResource::make(
            $this->areaRepository->all()->newQuery()
                ->findOrFail($data['area_id'])
                ->load('warehouses.warehouse')
        );

    }

    public function getAllWarehouses(){
     
        return  WarehousesResource::collection(
            $this->warehouseRepository->all()->newQuery()
                            ->get()
                            ->load(['warehouseArea.area.city' , 'user'])
        );
      
    }


  

}