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
        $dataShift = DB::table('shifts')
            ->leftJoin('karyawans', 'shifts.karyawan_id', '=', 'karyawans.karyawan_id')
            ->leftJoin('shifthours', 'shifts.shifthours_id', '=', 'shifthours.shifthours_id')
            ->select('karyawans.nik', 'karyawans.nama as karyawanName', 'shifthours.nama as shiftName','shifts.tanggal','shifts.shift_id')
            ->get();

        $data    = array (
            'data_shift' => $dataShift
        );
        return view('V_Shift',$data);
    }

    //app
    public function process_add_shift(Request $request)
    {
        $M_shift      = new M_shift();
        $shiftHour_value = $request->input('in_sh_value');
        $shiftHour_nama  = $request->input('in_sh_nama');
        $shiftHour_in    = $request->input('in_sh_in');
        $shiftHour_out   = $request->input('in_sh_out');

        $data = array(
            'created_at'  => now(),
            'updated_at'  => now(),
            'value'       => $shiftHour_value,
            'nama'        => $shiftHour_nama,
            'in'          => $shiftHour_in,
            'out'         => $shiftHour_out,
            'description' => ' '
        );
        $M_shift->add_data_shift('shifthours', $data);
        return redirect(url('shifts'));
    }
}
