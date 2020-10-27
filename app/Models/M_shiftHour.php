<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 

class M_shiftHour extends Model
{
    public function view_data($table, $where)
    {
        return DB::table($table)->where($where);
    }

    public function add_data_shiftHour($table, $data)
    {
        DB::table($table)->insert($data);
    }

    public function delete_data_shiftHour($table, $data)
    {
        DB::table($table)->delete($data);
    }
}
