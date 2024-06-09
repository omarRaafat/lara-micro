<?php 

namespace App\Http\Interfaces;

use Illuminate\Contracts\Support\Jsonable;

Interface IReport {


    public function generatePDF(Jsonable $qrcode);

   


}



