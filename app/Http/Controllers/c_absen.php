<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Karyawan;
use App\Models\M_shift;
use App\Models\M_absen;
use App\Models\M_shifthour;
use Carbon\Carbon;

class c_absen extends Controller
{
    public function index()
    {
        return view('v_absen');   
    }
    //app
    public function process_absen(Request $request)
    {
        $now = Carbon::now()->format('H:m');
        $M_karyawan = new M_karyawan;
        $M_shift = new M_shift;
        $M_shifthour = new M_shifthour;
        $barcode = $request->input('in_app_barcode');
        $whereKaryawan = array('is_active'=>'t',
                        'barcode'=>$barcode);
        $d_karyawan = $M_karyawan->view_data('karyawans',$whereKaryawan)->first();
        //dd($d_karyawan);
        if(!empty($d_karyawan)){
            $whereshift = array ('is_active'=>'t',
                             'karyawan_id'=>$d_karyawan['karyawan_id'],
                             'tanggal'=>Carbon::now()->format('Y-m-d'));
            $d_shift = M_shift::view_data('shifts',$whereshift)->first();
            if(!empty($d_shift)){
                $whereshiftHour = array ('is_active'=>'t',
                                        'shifthours_id'=>$d_shift['shifthours_id']);
                $d_shifthour = $M_shifthour->view_data('shifthours',$whereshiftHour)->first();
                if(!empty($d_shifthour)){
                    if($now > $d_shifthour['in']){

                    }
                }
            }
        }

    }
}
