<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class c_cekAbsen extends Controller
{
    public function home()
    {
        $d_karyawan = DB::table('karyawans')
        ->where('is_active',true)->get();
        return view('v_cekAbsen',$d_karyawan);   
    }

    public function GetAbsen()
    {
        $d_karyawan = DB::table('karyawans')
        ->where('is_active',true)->where('karyawan_id',$request->input('in_karyawan_id'))
        ->first();

        $d_shifts = DB::table('shifts')
        ->where('karyawan_id',$d_karyawan->karyawan_id)
        ->where('tanggal','>=',$request->input('dateFrom'))->where('tanggal','<=',$request->input('dateTo'))
        ->get();

        $data= array (
            'data_shift'     => $d_shifts,
        );       
        return view ('V_Absen',$data);
    }


}
