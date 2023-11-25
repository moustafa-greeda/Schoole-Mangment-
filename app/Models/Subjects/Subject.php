<?php

namespace App\Models\Subjects;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['Name'];
    protected $fillable = ['Name','grade_id','classroom_id','teacher_id'];


    // جلب اسم المراحل الدراسية

    public function grade()
    {
        return $this->belongsTo('App\Models\Grades\Grade', 'grade_id');
    }

    // جلب اسم الصفوف الدراسية
    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom\Classroom', 'classroom_id');
    }

    // جلب اسم المعلم
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teachers\Teacher', 'teacher_id');
    }
}
