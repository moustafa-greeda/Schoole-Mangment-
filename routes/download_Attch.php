<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ajaxCode Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

   //============================Translate All Pages==========================
   Route::group(['middleware' => 'auth:web,student'],function(){
         Route::get('download_file/{filename}', 'Download_AttchController@downloadAttachment')->name('downloadAttachment');
     });


