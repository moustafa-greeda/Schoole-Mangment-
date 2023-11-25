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

// Auth::routes();

// Route::group(['middleware'=>['guest']],function(){

//     Route::get('/' , function(){
//         return view('auth.login');
//     });

// });


    Route::get('/', 'HomeController@index')->name('selection');


    Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login/{type}','LoginController@loginForm')->middleware('guest')->name('login.show');

    Route::post('/login','LoginController@login')->name('login');
    
    Route::get('/logout/{type}', 'LoginController@logout')->name('logout');



    });

       //============================Translate All Pages==========================
        Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth' ]
        ], function(){

        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
     
        //================================= dashboard ============================
        Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

        // ============================= Grades ==================================
        Route::group(['namespace'=>'Grades'],function(){

            Route::resource('Grades','GradeController');
        });
        // ============================= Classrooms ================================
        Route::group(['namespace'=>'Classrooms'],function(){

            Route::resource('Classrooms','ClassroomController');
            Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
            Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
        });
        // ============================== Sections ================================
        Route::group(['namespace'=>'Sections'],function(){

            Route::resource('Sections','SectionController');
            Route::get('/classes/{id}', 'SectionController@getclasses');
        });
        // ================================ parent ===============================
        Route::view('add_parent','livewire.show_Form')->name('add_parent');

        // ============================ Teachers =================================
        Route::group(['namespace' => 'Teachers'],function(){
            Route::resource('Teachers','TeacherController');
        });
        // ======================== Students ==============================
        Route::group(['namespace' => 'Students'],function(){
            Route::resource('Students','StudentController');
            Route::resource('Promotion','PromotionController');
            Route::resource('Graduated','GraduatedController');
            // Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
            // Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
            Route::post('/upload_attachment', 'StudentController@upload_attachment')->name('upload_attachment');
            Route::get('Download_Attachment/{student_name}/{file_name}' , 'StudentController@Download_Attachment')->name('Download_Attachment');
            Route::post('Delete_Attachment' , 'StudentController@Delete_Attachment')->name('Delete_Attachment');
        });

        // ================================  Fees ================================
        Route::group(['namespace' => 'Fees'],function(){
            Route::resource('Fees' , 'FeesController');
            Route::resource('Fees_Invoices' , 'FeesInvoicesController');
            Route::resource('receipt_students' , 'ReceiptStudentsController');
            Route::resource('ProcessingFee' , 'ProcessingFeeController');
            Route::resource('Payment_students' , 'PaymentController');

        });

        // ============================= Attendaces ==============================
        Route::group(['namespace' => 'Attendances'] , function(){
            Route::resource('Attendances' , 'AttendanceController');
        });

        // ============================== Subjects ===============================
        Route::group(['namespace' => 'Subjects'] , function(){
            Route::resource('Subjects' , 'SubjectController');
        });

        // ================================== Exams ==============================
        Route::group(['namespace' => 'Quizzes'] , function(){
            Route::resource('Quizzes' , 'ExamController');
        });
        // =============================  questions ===============================
        Route::group(['namespace' => 'Questions'] , function(){
            Route::resource('Questions' , 'QuestionController');
        });
        // ================================ Librarys ==============================
        Route::group(['namespace' => 'Librarys'] , function(){
            Route::resource('library', 'LibraryController');
            Route::get('download_file/{filename}', 'LibraryController@downloadAttachment')->name('downloadAttachment');
        });
        // ===============================  Settings ==============================
        Route::resource('settings', 'SettingController');
        
    });
