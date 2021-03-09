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
        ->where('is_active',true)->orderby('nama','asc')->get();
        
        $filename = 'Data Shift Between '.$request->input('reservationdate-from').' - until -  '.$request->input('reservationdate-to');

        $export = \Excel::create($filename, function($excel) use ($period, $d_karyawan,$fromdate) {
            $excel->sheet('shift', function($sheet) use($period, $d_karyawan,$fromdate) {
                $sheet->appendRow(array(
                    'nama','tanggal','shift'
                ));
            
                for ($i = 0; $i <= $period; $i++) {
                    foreach($d_karyawan as $rowkaryawan) {
                        $sheet->appendRow(array(
                            $rowkaryawan->nama,
                            date('Y-m-d',strtotime($fromdate . "+".$i." days")),
                            ' '
                        ));
                    }   
                }
            });
        })->download('xlsx');
        
        return response()->json('Success exporting', 200);
        

    }

    
}
