<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
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

}
