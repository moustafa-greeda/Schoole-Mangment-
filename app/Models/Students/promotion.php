<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotion extends Model
{
    use HasFactory;
    protected $guarded=[];

    // علاقه بين الترقيات والطلاب لجلب اسم الطالب
    public function student(){
        return $this->belongsTo('App\Models\Students\Student' , 'student_id');
    }

    // علاقه بين الترقيات المراحل الدراسية لجلب اسم المرحله
    public function f_grade(){
        return $this->belongsTo('App\Models\Grades\Grade' , 'from_grade');
    }
    // علاقه بين الترقيات الصفوف الدراسيه لجلب اسم الصف
    public function f_classroom(){
        return $this->belongsTo('App\Models\Classroom\Classroom' , 'from_classroom');
    }

    // علاقه بين الترقيات الاقسام الدراسيه لجلب اسم القسم
    public function f_section(){
        return $this->belongsTo('App\Models\Sections\Section' , 'from_section');
    }

    // علاقه بين الترقيات المراحل الدراسية لجلب اسم المرحله الجديده
    public function t_grade(){
        return $this->belongsTo('App\Models\Grades\Grade' , 'to_grade');
    }
    // علاقه بين الترقيات الصفوف الدراسيه لجلب اسم الصف الجديده
    public function t_classroom(){
        return $this->belongsTo('App\Models\Classroom\Classroom' , 'to_classroom');
    }

    // علاقه بين الترقيات الاقسام الدراسيه لجلب اسم القسم الجديده
    public function t_section(){
        return $this->belongsTo('App\Models\Sections\Section' , 'to_section');
    }
}
