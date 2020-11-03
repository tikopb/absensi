<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Karyawan;
use DB;
use DataTables;

class c_karyawan extends Controller
{
    public function index()
    {
        return view('V_karyawan');
    }

    public function GetKaryawan(){
        $data = DB::table('karyawans')
        ->where('is_active',true);

        return DataTables::of($data)
                ->addColumn('option',function($data){
                    return ' <button type="button" id="Modal-edit-karyawan" name="Modal-edit-karyawan" class="btn btn-info"  data-id="'.$data->$karyawan_id.'" >
                    <i class="fas fa-pencil-alt">
                    </i>
                        Edit
                    </button>
                    <button type="button" id="Modal-delete-karyawan" name="Modal-delete-karyawan"class="btn btn-danger"  data-id="'.$data->$karyawan_id.'">
                        <i class="fas fa-trash">
                        </i>
                            Delete
                    </button>';
                })
                ->rawcolumns(['option'])
                ->make(true);
    }

    public function GetDetailKaryawan(Request $request)
    {
        $M_Karyawan = new M_Karyawan();
        $where = array('is_active'=>'t');
        $d_karyawan = $M_Karyawan->view_data('karyawans',$where)->first();
      
        dd($d_karyawan);
    }

    //app
    public function process_add_karyawan(Request $request)
    {
        $M_Karyawan = new M_Karyawan();
        $karyawan_nik = $request->input('in_kr_nik');
        $karyawan_nama = $request->input('in_kr_nama');
        $karyawan_barcode = $request->input('in_kr_barcode');
        $data = array(
            'created_at' => now(),
            'updated_at' => now(),
            'nik' => $karyawan_nik,
            'nama' => strtoupper($karyawan_nama),
            'barcode' => $karyawan_barcode,
            'fingerprint' => 'default'
        );
        $M_Karyawan->add_data_karyawan('karyawans', $data);
        return redirect(url('karyawan'));
    }
}
