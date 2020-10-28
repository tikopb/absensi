<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\M_shift;
use App\Models\M_Karyawan;
use App\Models\M_shiftHour;

class c_shift extends Controller
{
    public function index()
    {
        $M_Karyawan = new M_Karyawan();
        $M_shiftHour = new M_shiftHour();

        $dataShift = DB::table('shifts')
            ->leftJoin('karyawans', 'shifts.karyawan_id', '=', 'karyawans.karyawan_id')
            ->leftJoin('shifthours', 'shifts.shifthours_id', '=', 'shifthours.shifthours_id')
            ->select('karyawans.nik', 'karyawans.nama as karyawanName', 'shifthours.nama as shiftName','shifts.tanggal','shifts.shift_id')
            ->where('tanggal','>=','now()')
            ->orderby('tanggal')
            ->get();
        
        $where       = array('is_active'=>'t');
        $d_karyawan  = $M_Karyawan->view_data('karyawans', $where)->get();
        $d_shiftHour = $M_shiftHour->view_data('shifthours', $where)->get();
        $data    = array (
            'data_shift'     => $dataShift,
            'data_karyawan'  => $d_karyawan,
            'data_shiftHour' => $d_shiftHour
        );
        return view('V_Shift',$data);
    }

    //add shift
    public function process_add_shift(Request $request)
    {
        $M_shift = new M_shift();
        $karyawan_id_value  = $request->input('in_karyawan_id');
        $shifthour_id_value = $request->input('in_shifthour_id');
        $tanggal            = $request->input('testname');

        $d_shift = DB::table('shifts')->where('karyawan_id',$karyawan_id_value)->where('tanggal',$tanggal)->first();
        if($d_shift == null){
            $data = array(
                'created_at'    => now(),
                'updated_at'    => now(),
                'karyawan_id'   => $karyawan_id_value,
                'shifthours_id' => $shifthour_id_value,
                'tanggal'       => $tanggal,
                'shift'         => ''
            );
            DB::table('shifts')->insert($data);
        }else {
            $data = array(
                'updated_at' => now(),
                'shifthours_id' => $shifthour_id_value
            );
            DB::table('shifts')->where('shift_id',$d_shift->shift_id)->update($data);
        }
        return redirect(url('shifts'));
    }
}
