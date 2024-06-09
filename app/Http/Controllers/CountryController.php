<?php

namespace App\Http\Controllers;

use App\Http\Services\CountryService;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CountryService $countryService)
    {
        return $countryService->getCountriesList();
    }

  
}
