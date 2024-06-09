<?php 

namespace App\Http\Services;

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
use App\Http\Resources\CountriesResource;
use App\Http\Repositories\CountryRepository;

class CountryService {


    function __construct(public CountryRepository $countryRepository){}


   public function getCountriesList(){
        return CountriesResource::collection($this->countryRepository->allCountries());
   }


  

}