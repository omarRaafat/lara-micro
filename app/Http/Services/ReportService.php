<?php

namespace App\Http\Services;

use PDF;
use App\Models\User;
use App\Jobs\ProcessQrCode;
use Illuminate\Support\Str;
use App\Http\Interfaces\IReport;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Contracts\Support\Jsonable;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ReportService implements IReport
{



protected $user;
    function __construct()
    {
        $this->user = User::find(1);
    }


    public function generatePdfReport()
    {

        dispatch(new ProcessQrCode());
      
        $pdf = $this->generatePDF();
     
        return $pdf->download('laraveltuts.pdf');
    }


    public function generatePdfReportWithQr()
    {
        $qrcode = $this->generateQR();
        $pdf = $this->generatePDF($qrcode);
        return $pdf->download('laraveltuts.pdf');
    }

    public function generatePDF($qrcode = null)
    {



        // Generate PDF report
        $data = [
            'title' => 'Invoice Details',
            'invoice_number' => Str::random(15),
            'qrcode' => $qrcode
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf;
    }


    public function generateQR()
    {
        $qrcode = QrCode::format('svg')->size(200)->errorCorrection('H')->generate(
            User::find(1)

        );
        return $qrcode;
    }
}
