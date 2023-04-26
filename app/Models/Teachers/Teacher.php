<?php

namespace App\Models\Teachers;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $guarded = [];
    public $translatable = ['Name'];

    // علاقة بين المعلمين والانواع لجلب جنس المعلم
    public function genders(){
        return $this->belongsTo('App\Models\Genders\Gender' , 'Gender_id');
    }
    
    // علاقة بين المعلمين والتخصصات لجلب اسم التخصص
    public function specializations(){
        return $this->belongsTo('App\Models\Specializations\Specialization' , 'Specialization_id');
    }
    // علاقة المعلمين مع الاقسام
    public function sections(){
        return $this->belongsToMany('App\Models\Sections\Section' , 'teacher_section');
    }
}
