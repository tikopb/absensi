<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_shift;
use App\Models\M_Karyawan;
use App\Models\M_shiftHour;

class c_shift extends Controller
{
    public function index()
    {
        $M_shift = new M_shift();
        $M_Karyawan = new M_Karyawan();
        $M_shiftHour = new M_shiftHour();
        $where   = array('is_active'=>'t');

        $d_shift = $M_shift->view_data('shifthours',$where)->get();
        $data    = array (
            'data_shift' => $d_shift
        );
        return view('V_shift',$data);
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
