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
   Route::group(['middleware' => 'auth:web,teacher'],function(){
      Route::get('/Get_classrooms/{id}', 'ajaxCodeController@Get_Classrooms');
      Route::get('/Get_Sections/{id}', 'ajaxCodeController@Get_Sections');
   });


