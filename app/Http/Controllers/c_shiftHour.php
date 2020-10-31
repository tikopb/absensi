<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_shiftHour;


class c_shiftHour extends Controller
{
    public function index()
    {
        $M_shiftHour = new M_shiftHour();
        $where       = array('is_active'=>'t');
        $d_shiftHour = $M_shiftHour->view_data('shifthours',$where)->get();
        $data        = array (
            'data_shiftHour' => $d_shiftHour
        );
        return view('V_shiftHours',$data);
    }

    //app
    public function process_add_shiftHour(Request $request)
    {
        $M_shiftHour      = new M_shiftHour();
        $shiftHour_value = $request->input('in_sh_value');
        $shiftHour_nama  = $request->input('in_sh_nama');
        $shiftHour_in    = $request->input('in_sh_in');
        $shiftHour_out   = $request->input('in_sh_out');

        $data = array(
            'created_at'  => now(),
            'updated_at'  => now(),
            'value'       => strtoupper($shiftHour_value),
            'nama'        => strtoupper($shiftHour_nama),
            'timein'          => $shiftHour_in,
            'timeout'         => $shiftHour_out,
            'description' => ' '
        );
        $M_shiftHour->add_data_shiftHour('shifthours', $data);
        return redirect(url('shiftHour'));
    }
}
