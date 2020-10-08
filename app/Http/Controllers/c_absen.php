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
        $now = Carbon::now()->format('H:i');
        //dd($now);
        $M_karyawan = new M_karyawan;
        $M_shift = new M_shift;
        $M_shifthour = new M_shifthour;
        $M_Absen = new M_absen;
        $barcode = $request->input('in_app_barcode');
        $whereKaryawan = array('is_active'=>'t',
                        'barcode'=>$barcode);
        $d_karyawan = $M_karyawan->view_data('karyawans',$whereKaryawan)->first();
      
        if(!empty($d_karyawan)){
           // dd($d_karyawan);
            $whereshift = array ('is_active'=>'t',
                             'karyawan_id'=>$d_karyawan['karyawan_id'],
                             'tanggal'=>Carbon::now()->format('Y-m-d'));
            $d_shift = M_shift::view_data('shifts',$whereshift)->first();
            if(!empty($d_shift)){
                $whereshiftHour = array ('is_active'=>'t',
                                        'shifthours_id'=>$d_shift['shifthours_id']);
                $d_shifthour = $M_shifthour->view_data('shifthours',$whereshiftHour)->first();
                if(!empty($d_shifthour)){
                    $where_absen = array('is_active'=>'t',
                                        'karyawan_id'=>$d_karyawan['karyawan_id'],
                                        'shift_id'=>$d_shift['shift_id']);
                    $d_absen = M_absen::view_data('absens',$where_absen)->first();
                    if(!empty($d_absen)){
                        $data = array(
                            'updated_by' => $d_karyawan['karyawan_id'],
                            'updated_at' => now(),
                            'karyawan_id' => $d_karyawan['karyawan_id'],
                            'shift_id' => $d_shift['shift_id'],
                            'out' => now()
                        );
                        $whereupdate = array('is_active'=>'t');
                        M_absen::update_data($whereupdate,'absens',$data) ;
                    }
                    else{
                        $in = $d_shifthour['in']->format('H:i');
                        if($now > $in){
                            $data = array(
                                'created_by' => $d_karyawan['karyawan_id'],
                                'updated_by' => $d_karyawan['karyawan_id'],
                                'created_at' => now(),
                                'updated_at' => now(),
                                'karyawan_id' => $d_karyawan['karyawan_id'],
                                'shift_id' => $d_shift['shift_id'],
                                'in' => now(),
                                'description' => 'Datang Tepat Waktu'
                            );
                            M_absen::add_data_process('absens',$data) ;
                        }else if($now < $in){
                            $data = array(
                                'created_by' => $d_karyawan['karyawan_id'],
                                'updated_by' => $d_karyawan['karyawan_id'],
                                'created_at' => now(),
                                'updated_at' => now(),
                                'karyawan_id' => $d_karyawan['karyawan_id'],
                                'shift_id' => $d_shift['shift_id'],
                                'in' => now(),
                                'description' => 'Terlambat Datang'
                            );
                            M_absen::add_data_process('absens',$data) ;
                        }
                    }
                }
            }
        }
    }
}
