<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->bigIncrements('shift_id');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->bigInteger('karyawan_id');
            $table->string('shift', 5);
            $table->date('tanggal');
            $table->bigInteger('shifthours_id');
            
            $table->foreign('karyawan_id')->references('karyawan_id')->on('karyawans');
            $table->foreign('shifthours_id')->references('shifthours_id')->on('shifthours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}
