<?php

use Illuminate\Http\Request;
use App\Models\Students\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    //============================Translate All Pages==========================
    Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth:parent' ]
    ], function(){

    // ==============================   dashboard    ============================
    Route::get('/parent/dashboard', function () {
        $sons = Student::where('parent_id' , auth()->user()->id)->get();
        return view('pages.Parents.dashboard' , compact('sons'));
        
    })->name('parents');
    
    //==============================    parents  ============================
    Route::group(['namespace' => 'Parents\dashboard'] , function(){
        Route::get('children' , 'ChildernController@index')->name('sons.index');
        Route::get('children_result/{id}' , 'ChildernController@children_result')->name('sons.result');
        Route::get('childern_attendance' , 'ChildernController@children_attendance')->name('sons.attendance');
        Route::post('children_attendance_search' , 'ChildernController@childern_attendanceSearch')->name('sons.attendance.search');
        Route::get('fees_invoices' , 'ChildernController@fees_invoices')->name('sons.invoices');
        Route::get('receiptStudent/{id}' , 'ChildernController@receiptStudent')->name('sons.receipt');
        Route::get('parent_profile' , 'ChildernController@profile')->name('parents.profile');
        Route::post('update_profile/{id}' , 'ChildernController@update')->name('profile.update.parent');
    });
    



});

