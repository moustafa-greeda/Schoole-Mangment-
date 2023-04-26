<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::group(['middleware'=>['guest']],function(){

    Route::get('/' , function(){
        return view('auth.login');
    });

});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth' ]
    ], function(){

        Route::get('/dashboard', 'HomeController@index')->name('dashboard');

        // ========================= Grades ===============================
        Route::group(['namespace'=>'Grades'],function(){

            Route::resource('Grades','GradeController');
        });
        // ======================= Classrooms =============================
        Route::group(['namespace'=>'Classrooms'],function(){

            Route::resource('Classrooms','ClassroomController');
            Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
            Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
        });
        // ======================== Sections ==============================
        Route::group(['namespace'=>'Sections'],function(){

            Route::resource('Sections','SectionController');
            Route::get('/classes/{id}', 'SectionController@getclasses');
        });
        // ======================== Sections ==============================
        Route::view('add_parent','livewire.show_Form');

        // ======================== Teachers ==============================
        Route::group(['namespace' => 'Teachers'],function(){
            Route::resource('Teachers','TeacherController');
        });
        // ======================== Students ==============================
        Route::group(['namespace' => 'Students'],function(){
            Route::resource('Students','StudentController');
            Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
            Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
            Route::post('/upload_attachment', 'StudentController@upload_attachment')->name('upload_attachment');
            Route::get('Download_Attachment/{student_name}/{file_name}' , 'StudentController@Download_Attachment')->name('Download_Attachment');
            Route::post('Delete_Attachment' , 'StudentController@Delete_Attachment')->name('Delete_Attachment');
        });

    
    });
