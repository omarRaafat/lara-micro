<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function create(Request $request)
    {
        // return $request;
      
    	$request->validate([
            'title'=>'required'   
        ]);
    	$items = Item::create($request->all());
    	return $items;
    }
}
