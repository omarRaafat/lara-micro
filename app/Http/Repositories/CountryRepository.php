<?php 


namespace App\Http\Repositories;
use App\Models\Area;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository extends BaseRepository  {


  
   

    public function model() : string{
        return Country::class;
    }

    public function allCountries(){
        return $this->model->with([
            'cities'       => fn($city)=> $city->inRandomOrder(),
            'cities.areas' => fn($area)=> $area->inRandomOrder()
        ])->get();
    }


   
}



?>