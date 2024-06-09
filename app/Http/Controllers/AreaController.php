<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaFormRequest;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Services\AreaService;

class AreaController extends Controller
{

    function __construct(public AreaService $areaService){}
  
    public function index()
    {
        return $this->areaService->getAreas();
    }

   
    public function store(AreaFormRequest $request)
    {
        return $this->areaService->storeArea($request);
    }

   
    public function update(Request $request, Area $area)
    {
        //
    }

       public function destroy(Area $area)
    {
        //
    }

    public function areaWarehouses(Request $request){
        return $this->areaService->getAreaWarehouses($request);
    }
}
