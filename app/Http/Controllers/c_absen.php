<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Karyawan;
use App\Models\M_shift;
use App\Models\M_absen;
use App\Models\M_shifthour;

class c_absen extends Controller
{
    public function index()
    {
        return view('v_absen');   
    }
    //app
    public function process_absen(Request $request)
    {
        $M_karyawan = new M_karyawan;
        $M_shift = new M_shift;
        $M_shifthour = new M_shifthour;
        $barcode = $request->input('in_app_barcode');
        $whereKaryawan = array('is_active'=>'t',
                        'barcode'=>$barcode);
        $d_karyawan = $M_karyawan->view_data('karyawans',$whereKaryawan)->get();

        if(!empty($d_karyawan)){
            $whereshift = array ('is_active'=>'t',
                             'karyawan_id'=>$d_karyawan['karyawan_id'],
                             'tanggal'=>now());
            $d_shift = $M_shift->view_data('shifts',$whereshift)->get();
            if(!empty($d_shift)){
                $whereshiftHour = array ('is_active'=>'t',
                                        'shifthours_id'=>$d_shift['shifthours_id']);
                $d_shifthour = $M_shifthour->view_data('shifthours',$whereshiftHour)->get();
                if(!empty($d_shifthour)){
                    // get now()

                }
            }
        }

    }
}
