<?php

namespace App\Http\Services;

use PDF;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Interfaces\IReport;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Contracts\Support\Jsonable;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\ImageManagerStatic as Image;

class ImageHandlerService 
{




    function __construct()
    {

        
    }


    public function upload($image)

{
    
    $filename = time() . '.' . $image->getClientOriginalExtension();
    Image::make($image)->resize(300,300);

    return response()->json(['status' => 'success', 'filename' => $filename]);
}

   
}
