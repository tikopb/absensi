<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\M_Karyawan;
use App\Models\M_shift;
use App\Models\M_absen;
use App\Models\M_shiftHour;
use Carbon\Carbon;

class c_absen extends Controller
{
    public function homeAbsen()
    {
        return view('v_homeabsen');   
    }
    
    public function index()
    {
        $M_Karyawan = new M_Karyawan();
        $M_shiftHour = new M_shiftHour();

        $dataAbsen = DB::table('absens')
        ->leftJoin('shifts', 'absens.shift_id', '=', 'shifts.shift_id')
        ->leftJoin('karyawans', 'absens.karyawan_id', '=', 'karyawans.karyawan_id')
        ->select('shifts.tanggal', 'karyawans.nama as karyawanName','absens.in','absens.out','absens.description')
        ->orderby('shifts.tanggal')
        ->get();

        $where       = array('is_active'=>'t');
        $d_karyawan  = $M_Karyawan->view_data('karyawans', $where)->get();

        $data = array (
            'data_Absen' => $dataAbsen,
            'data_karyawan'  => $d_karyawan
        );
        return view ('V_Absen',$data);
    }

    //app
    public function process_absen(Request $request)
    {
        $now = Carbon::now()->format('H:i');
        //dd($now);
        $M_karyawan = new M_karyawan;
        $M_shift = new M_shift;
        $M_shiftHour = new M_shiftHour;
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
                $d_shifthour = $M_shiftHour->view_data('shifthours',$whereshiftHour)->first();
                if(!empty($d_shifthour)){
                    $where_absen = array('is_active'=>'t',
                                        'karyawan_id'=>$d_karyawan['karyawan_id'],
                                        'shift_id'=>$d_shift['shift_id']);
                    $d_absen = M_absen::view_data('absens',$where_absen)->first();
                    if(!empty($d_absen)){
                        $data = array(
                            'updated_by'  => $d_karyawan['karyawan_id'],
                            'updated_at'  => now(),
                            'karyawan_id' => $d_karyawan['karyawan_id'],
                            'shift_id'    => $d_shift['shift_id'],
                            'out'         => now()
                        );
                        $whereupdate = array('is_active'=>'t');
                        M_absen::update_data($whereupdate,'absens',$data) ;
                    }
                    else{
                        $in = $d_shifthour['in']->format('H:i');
                        if($now > $in){
                            $data = array(
                                'created_by'  => $d_karyawan['karyawan_id'],
                                'updated_by'  => $d_karyawan['karyawan_id'],
                                'created_at'  => now(),
                                'updated_at'  => now(),
                                'karyawan_id' => $d_karyawan['karyawan_id'],
                                'shift_id'    => $d_shift['shift_id'],
                                'in'          => now(),
                                'description' => 'Datang Tepat Waktu'
                            );
                            M_absen::add_data_process('absens',$data) ;
                        }else if($now < $in){
                            $data = array(
                                'created_by'  => $d_karyawan['karyawan_id'],
                                'updated_by'  => $d_karyawan['karyawan_id'],
                                'created_at'  => now(),
                                'updated_at'  => now(),
                                'karyawan_id' => $d_karyawan['karyawan_id'],
                                'shift_id'    => $d_shift['shift_id'],
                                'in'          => now(),
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
