<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'c_absen@homeAbsen')->name('homepage');
Route::get('/abseninsucess', 'c_absen@homeAbsenInSucess')->name('abseninsucess');
Route::get('/absenoutsucess', 'c_absen@homeAbsenOutSucess')->name('absenoutsucess');
Route::get('/absenfail', 'c_absen@homeAbsenFail')->name('absenfail');
Route::post('process-absen', 'c_absen@process_absen')->name('process_absen')->name('process-absen');
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/karyawan', 'c_karyawan@index')->name('karyawan');
    //add karyawan
    Route::post('process_add_karyawan', 'c_karyawan@process_add_karyawan')->name('process_add_karyawan')->name('process_add_karyawan');

    Route::get('/shiftHour','c_shiftHour@index')->name('shiftHour');
    //add shift Hour
    Route::post('process_add_shiftHour', 'c_shiftHour@process_add_shiftHour')->name('add_data_shiftHour');

    //shift
    Route::get('/shifts','c_shift@index')->name('shifts');
    Route::post('process_add_shift', 'c_shift@process_add_shift')->name('add_data_shift')->name('process_add_shift');
    Route::post('uploud_shift','c_shift@uploadShiftXls')->name('uploud_shift');
    Route::post('download_shift','c_shift@DownloadShiftXls')->name('download_shift')->name('download_shift');

    //absensi
    Route::get('/absensi','c_absen@index')->name('absensi');
    Route::post('process_add_manual_absen','c_absen@process_manual_absen')->name('process_add_manual_absen');

});
