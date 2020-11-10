<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Karyawan;


class c_karyawan extends Controller
{
    public function index()
    {
        $M_Karyawan = new M_Karyawan();
        $where = array('is_active'=>'t');
        $d_karyawan = $M_Karyawan->view_data('karyawans',$where)->get();
        $data = array (
            'data_karyawan' => $d_karyawan
        );
        return view('V_karyawan',$data);
    }

    //app
    public function process_add_karyawan(Request $request)
    {
        $M_Karyawan = new M_Karyawan();
        $karyawan_nik = $request->input('in_kr_nik');
        $karyawan_nama = $request->input('in_kr_nama');
        $karyawan_barcode = $request->input('in_kr_barcode');
        $email = $request->input('in_kr_email');
        $data = array(
            'created_at' => now(),
            'updated_at' => now(),
            'nik' => $karyawan_nik,
            'nama' => strtoupper($karyawan_nama),
            'barcode' => $karyawan_barcode,
            'fingerprint' => 'default',
            'email' => $email
        );
        $M_Karyawan->add_data_karyawan('karyawans', $data);
        return redirect(url('karyawan'));
    }
}
