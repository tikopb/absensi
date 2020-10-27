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

Route::get('/', 'c_absen@homeAbsen');
Route::post('process-absen', 'c_absen@process_absen')->name('process_absen');
Route::get('/home', 'HomeController@index');

Route::get('/karyawan', 'c_karyawan@index');
 //add karyawan
 Route::post('process_add_karyawan', 'c_karyawan@process_add_karyawan')->name('process_add_karyawan');

Route::get('/shiftHour','c_shiftHour@index');
 //add shift Hour
 Route::post('process_add_shiftHour', 'c_shiftHour@process_add_shiftHour')->name('add_data_shiftHour');

 Route::get('/shifts','c_shiftHour@index');
 