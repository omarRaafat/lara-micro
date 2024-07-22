<?php

namespace App\Http\Services;

use App\Models\City;
use App\Models\User;
use App\Models\Order;
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

class OrderService
{


    public function getOrders(Request $request)
    {
        $value =  $request->get('value');

        $orders = Order::query();

        $orders->when($request->input('value') , 
            fn($q) => $q->selectRaw("user_id, $value(total) as $value")
                        
        );


        return $orders->with('user:id,name as username,email')
            ->groupBy('user_id')
            ->get()
            ->makeHidden('user_id');
    }






}