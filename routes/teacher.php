<?php

use Illuminate\Http\Request;
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
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth:teacher' ]
    ], function(){

    //==============================   dashboard    ============================
    Route::get('/teacher/dashboard', function () {
        $ids = DB::table('teacher_section')->where('teacher_id' , auth()->user()->id)->pluck('section_id');
        $count_section = $ids->count();

        $count_student = DB::table('students')->whereIn('section_id' , $ids)->count();
        // $count_student =  \App\Models\Students\Student::whereIn('section_id' , $ids)->count();
        return view('pages.Teachers.dashboard', compact('count_section' , 'count_student'));
    });

    //==============================    students  ============================
    Route::group(['namespace'=> 'Teachers\dashboard'] , function(){
        Route::get('Student' , 'StudentController@index')->name('Student.index');
        Route::get('Section' , 'StudentController@section')->name('section');
        Route::post('Attendance' , 'StudentController@attendance')->name('attendance');
        Route::get('attendance_report','StudentController@attendanceReport')->name('attendance.report');
        Route::post('attendance_search','StudentController@attendanceSearch')->name('attendance.search');
        // Quizze
        Route::resource('quizzes' , 'QuizzesController');
        Route::get('student_quizze/{id}' , 'QuizzesController@student_quizze')->name('student_quizze');
        Route::post('repeat.quizze/{id}' , 'QuizzesController@repeat_quizze')->name('repeat.quizze');
        Route::resource('questions' , 'QuestionController');
        // setting 
        Route::get('profile' , 'profileController@index')->name('profile.show');
        Route::post('profile/{id}' , 'profileController@update')->name('profile.update');

    });



});

