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

    public function homeAbsenInSucess()
    {
        return view('v_homeabsen_sucessin');   
    }

    public function homeAbsenOutSucess()
    {
        return view('v_homeabsen_sucessout');   
    }

    public function homeAbsenFail()
    {
        return view('v_homeabsen_fail');   
    }
    
    public function index()
    {
        $M_Karyawan = new M_Karyawan();
        $M_shiftHour = new M_shiftHour();

        $dataAbsen = DB::table('absens')
        ->leftJoin('shifts', 'absens.shift_id', '=', 'shifts.shift_id')
        ->leftJoin('karyawans', 'absens.karyawan_id', '=', 'karyawans.karyawan_id')
        ->select('shifts.tanggal', 'karyawans.nama as karyawanName','absens.timein','absens.timeout','absens.description')
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

    public function process_absen(Request $request)
    {   
        $d_karyawan = DB::table('karyawans')
        ->where('is_active',true)->where('barcode',$request->input('in_app_barcode'))
        ->first();
        
        if($d_karyawan != null){
        $d_shift = DB::table('shifts')
        ->where('is_active',true)->where('karyawan_id',$d_karyawan->karyawan_id)
        ->where('tanggal',now())->first();

            if($d_shift!=null){
                $d_absen = DB::table('absens')
                ->where('is_active',true)->where('karyawan_id',$d_karyawan->karyawan_id)
                ->where('shift_id',$d_shift->shift_id)->first();

                $d_shifthour = DB::table('shifthours') 
                ->where('is_active',true)->where('shifthours_id',$d_shift->shifthours_id)
                ->first();
                    
                $timeShiftin = strtotime($d_shifthour->timein);
                $cur_time    = strtotime(now());
                if($timeShiftin > $cur_time)
                {
                    $keterangan = 'Tidak Terlambat';
                }else 
                {
                    $keterangan = 'Terlambat';
                }

                if($d_absen == null ){
                    $data = array(
                        'created_at'  => now(),
                        'updated_at'   => now(),
                        'karyawan_id' => $d_karyawan->karyawan_id,
                        'nik'         => $d_karyawan->nik,
                        'nama'        => $d_karyawan->nama,
                        'timein'      => now(),
                        'shift_id'    => $d_shift->shift_id,
                        'description' => $keterangan
                    );
                    DB::table('absens')->insert($data);
                    return redirect(url('/abseninsucess'));
                }else{
                    $data = array(
                        'updated_at' => now(),
                        'timeout'     => now(),
                        'description' => $keterangan
                    );
                    DB::table('absens')->where('absen_id',$d_absen->absen_id)->update($data);
                    return redirect(url('/absenoutsucess'));
                }
            }else {
                return redirect(url('/absenfail'));
            }
        } else {
            return redirect(url('/absenfail'));
        }
    }
    public function process_manual_absen(Request $request)
    {
        $karyawan_id = $request->input('in_karyawan_id');
        $d_karyawan = DB::table('karyawans')
        ->where('is_active',true)->where('karyawan_id',$karyawan_id)
        ->first();

        $tanggal = $request->input('date_absen');
        $d_shift = DB::table('shifts')
        ->where('is_active',true)->where('tanggal',$tanggal)
        ->where('karyawan_id',$karyawan_id)
        ->first();

        $d_absens = DB::table('absens')
        ->where('is_active',true)->where('karyawan_id',$karyawan_id)
        ->where('shift_id',$d_shift->shift_id)->first();

        if($d_absens == null){
            $data = array(
                'created_at'  => now(),
                'updated_at'   => now(),
                'karyawan_id' => $karyawan_id,
                'nik'         => $d_karyawan->nik,
                'nama'        => $d_karyawan->nama,
                'timein'      => $request->input('in_ab_in'),
                'timeout'     => $request->input('in_ab_out'),
                'shift_id'    => $d_shift->shift_id,
                'description' => $request->input('in_ab_des')
            );
            DB::table('absens')->insert($data);
        }else {
            $data = array(
                'updated_at' => now(),
                'timein'      => $request->input('in_ab_in'),
                'timeout'     => $request->input('in_ab_out'),
                'description' => $request->input('in_ab_des')
            );
            DB::table('absens')->where('absen_id',$d_absens->absen_id)->update($data);
        }
        return redirect(url('absen'));
    }
}
