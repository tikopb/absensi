<?php

namespace App\Http\Controllers\reportingController;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class C_R_PerPeriod extends Controller
{
    public function index()
    {
        return view('report.V_R_PerPeriod');   
    }

    public function DownloadShiftXls(Request $request){
        $fromdate = date_format(date_create($request->input('reservationdate-from')), 'Y-m-d');
        $todate = date_format(date_create($request->input('reservationdate-to')), 'Y-m-d');

        $d_karyawan = DB::table('karyawans')
        ->where('is_active',true)->orderby('karyawan_id','asc')->get();

        

    }
}
