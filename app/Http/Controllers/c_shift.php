<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Models\M_shift;
use App\Models\M_Karyawan;
use App\Models\M_shiftHour;
use Excel;

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
        $karyawan_id  = $request->input('in_karyawan_id');
        $shifthour_id = $request->input('in_shifthour_id');
        $tanggal            = $request->input('testname');

        $this->addShift($karyawan_id,$tanggal,$shifthour_id);
        return redirect(url('shifts'));
    }

    public function uploadShiftXls(Request $request){
        if($request->hasFile('file_upload')){
            $extension = \File::extension($request->file_upload->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls") {
                $path = $request->file_upload->getRealPath();
                $datax = \Excel::selectSheetsByIndex(0)->load($path)->get();  
                try{
                    foreach ($datax as $dx) {
                        
                        $nama = trim(strtoupper($dx->nama));
                        $tanggal =  date_format(date_create(trim($dx->tanggal)), 'Y-m-d');
                        //$tanggal = Carbon::createFromFormat('d F, Y', trim($dx->tanggal))->format('Y-m-d');
                        $shift = trim(strtoupper($dx->shift));

                        $d_karyawan = DB::table('karyawans')
                        ->where('nama',$nama)->where('is_active',true)->first();

                        $d_shiftHour = DB::table('shifthours')
                        ->where('value',$shift)->where('is_active',true)->first();

                        $this->addShift($d_karyawan->karyawan_id,$tanggal,$d_shiftHour->shifthours_id);
                    }
                }
                catch (Exception $ex) {
                    db::rollback();
                    $message = $ex->getMessage();
                            \ErrorHandler($message);
          
                  $data_response = [
                                      'status' => 422,
                                      'output' => 'upload failed !!!'
                                    ];
                }
            }
            return redirect(url('shifts'));
        }else{
            return redirect(url('shifts'));
        }
    }

    private function addShift($karyawan_id,$tanggal,$shifthour_id){
        $d_shift = DB::table('shifts')->where('karyawan_id',$karyawan_id)->where('tanggal',$tanggal)->first();
        if($d_shift == null){
            $data = array(
                'created_at'    => now(),
                'updated_at'    => now(),
                'karyawan_id'   => $karyawan_id,
                'shifthours_id' => $shifthour_id,
                'tanggal'       => $tanggal,
                'shift'         => ''
            );
            DB::table('shifts')->insert($data);
        }else {
            $data = array(
                'updated_at' => now(),
                'shifthours_id' => $shifthour_id
            );
            DB::table('shifts')->where('shift_id',$d_shift->shift_id)->update($data);
        }
        return true;
    }
}
