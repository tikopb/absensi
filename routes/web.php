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

Route::get('/', 'c_absen@index');
Route::post('process-absen', 'c_absen@process_absen')->name('process_absen');
Route::get('/home', 'HomeController@index');

Route::get('/karyawan', 'c_karyawan@index');
 //app
 Route::post('process_add_karyawan', 'c_karyawan@process_add_karyawan')->name('process_add_karyawan');