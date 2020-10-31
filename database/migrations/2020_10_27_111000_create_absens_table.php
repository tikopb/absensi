<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absens', function (Blueprint $table) {
            $table->bigIncrements('absen_id');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->string('nik', 100)->nullable();
            $table->string('nama', 100)->nullable();
            $table->time('timein', 0);
            $table->time('timeout', 0)->nullable();
            $table->bigInteger('karyawan_id');
            $table->bigInteger('shift_id');
            $table->string('description', 100);
            
            $table->foreign('karyawan_id')->references('karyawan_id')->on('karyawans');
            $table->foreign('shift_id')->references('shift_id')->on('shifts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absens');
    }
}
