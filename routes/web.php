<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
'register'=>false
]);

Route::resources([
    'ringtone'         =>App\Http\Controllers\RingToneController::class,
    'photo'            =>App\Http\Controllers\PhotoController::class,
]);

Route::get('/', [App\Http\Controllers\FrontEndController::class, 'index'])->name('home');
Route::get('/ringtone/{id}/{slug}',[App\Http\Controllers\FrontEndController::class,'oneRingtone'])->name('ringtone_one');

Route::post('/ringtone/donwload/{id}',[App\Http\Controllers\FrontEndController::class,'downloadRington'])->name('ringtone_download');

Route::get('/category/{id}/ringtones/',[App\Http\Controllers\FrontEndController::class,'ringtonesByCategory'])->name('ring_category');

Route::get('/wallpapers/',[App\Http\Controllers\PhotoFrontEndController::class,'index'])->name('wallpapers');

//photo download links
Route::post('/donwload1/{id}',[App\Http\Controllers\PhotoFrontEndController::class,'download_800_600'])->name('donwload1');
Route::post('/donwload2/{id}/',[App\Http\Controllers\PhotoFrontEndController::class,'download_1280_1024'])->name('donwload2');
Route::post('/donwload3/{id}/',[App\Http\Controllers\PhotoFrontEndController::class,'download_316_255'])->name('donwload3');
Route::post('/donwload4/{id}/',[App\Http\Controllers\PhotoFrontEndController::class,'download_118_95'])->name('donwload4');


