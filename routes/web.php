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

use App\Http\Controllers\SiswaController;

Route::get('/', 'PagesController@homepage');

Route::get('about', 'PagesController@about');

//Named Route Cara 1
// Route::get('halaman-rahasia','RahasiaController@halamanRahasia'
//     'as' => 'secret',
//     'uses' => 'RahasiaController@halamanRahasia'
// ]);
//Named Route Cara 2
Route::get('halaman-rahasia', 'RahasiaController@halamanRahasia')
->name('secret');
Route::get('showmesecret', 'RahasiaController@showMeSecret');

Route::get('siswa', 'SiswaController@index');
Route::get('siswa/create','SiswaController@create');
Route::post('siswa','SiswaController@store');
Route::get('siswa/{siswa}', 'SiswaController@show');
Route::get('siswa/{siswa}/edit', 'SiswaController@edit');
Route::patch('siswa/{siswa}', 'SiswaController@update');
Route::delete('users/{siswa}', 'SiswaController@destroy');
//belajar Eloquent:Collection
// Route::get('tes-collection','SiswaController@testCollection');
Route::get('date-mutator', 'SiswaController@dateMutator');
