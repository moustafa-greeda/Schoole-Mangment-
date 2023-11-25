<?php

namespace App\Models\Students;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable
{
    use SoftDeletes;
    use HasFactory;
    use HasTranslations;
    public $translatable =['name'];
    // علاقه بين الطلاب والنوع لجلب النوع ف جدول الطلاب
    public function gender(){
        return $this->belongsTo('App\Models\Genders\Gender' , 'gender_id');
    }
    // علاقه بين الطلاب و المرحله الدراسيه لجلب المرحله ف جدول الطلاب
    public function grade(){
        return $this->belongsTo('App\Models\Grades\Grade' , 'Grade_id');
    }
    // علاقه بين الطلاب الصفوف لجلب الصفوف ف جدول الطلاب
    public function classroom(){
        return $this->belongsTo('App\Models\Classroom\Classroom' , 'Classroom_id');
    }
    // علاقه بين الطلاب الاقسام لجلب الاقسام ف جدول الطلاب
    public function section(){
        return $this->belongsTo('App\Models\Sections\Section' , 'section_id');
    }
    // علاقة بين الطلاب والصور لجلب اسم الصور  في جدول الطلاب
    public function images()
    {
        return $this->morphMany('App\Models\Images\Image', 'imageable');
    }
    // علاقة بين الطلاب والجنسيات لجلب اسم الجنسيه  في جدول الطلاب
    public function Nationality(){
        return $this->belongsTo('App\Models\Nationalities\Nationalitie' , 'nationalitie_id');
    }
    // علاقة بين الطلاب واولياء الامور  لجلب اسم ولي لامر في جدول الطلاب
    public function myparent(){
        return $this->belongsTo('App\Models\MyParent\MyParent' , 'parent_id');
    }


    // علاقة بين جدول سدادت الطلاب وجدول الطلاب لجلب اجمالي المدفوعات والمتبقي
    public function student_account()
    {
        return $this->hasMany('App\Models\Fees\StudentAccount', 'student_id');

    }

    //علاقه بين جدول الحضور والطلاب لجلب جدول الخضور
    public function attendance(){
        return $this->hasMany('App\Models\Attendances\Attendance' , 'student_id');
    }

}
