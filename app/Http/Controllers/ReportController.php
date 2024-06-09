<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ReportService;
use Illuminate\Support\Facades\Cookie;
use Spatie\Permission\Middleware\PermissionMiddleware;


class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
   
    public function __construct(){
       

     }
    public function geenrateReport(ReportService $reportService , Request $request)
    {
        // Cookie::make('report_data' , 'generate-report-1' , 1 ,'localhost' , true);
        return $request->type == 1?$reportService->generatePdfReport():$reportService->generatePdfReportWithQr();
    }
}
