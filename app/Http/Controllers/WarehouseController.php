<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseRequest;
use App\Http\Services\WarehouseService;
use App\Models\Warehouse;
use App\Traits\HandleResponse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    use HandleResponse;

    function __construct(public WarehouseService $warehouseService){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->warehouseService->getAllWarehouses();
        
    }

    public function store(WarehouseRequest $warehouseRequest){
        return $this->warehouseService->createWarehouse($warehouseRequest->validated());
    }

    public function update(WarehouseRequest $warehouseRequest , $warehouse_id){
    
         if($this->warehouseService->updateWarehouse($warehouseRequest->validated() , $warehouse_id))
            return $this->handelResponse(
                    200,
                    [],
                    'warehouse updated'
                  );
    }

    public function destroy($warehouse_id){
        if($this->warehouseService->deleteWarehouse($warehouse_id))
            return $this->handelResponse(
                    200,
                    [],
                    'warehouse deleted'
                  );
    }
   
}
