<?php

namespace App\Models\Quizzes;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class quizze extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teachers\Teacher', 'teacher_id');
    }



    public function subject()
    {
        return $this->belongsTo('App\Models\Subjects\Subject', 'subject_id');
    }


    public function grade()
    {
        return $this->belongsTo('App\Models\Grades\Grade', 'grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom\Classroom', 'classroom_id');
    }


    public function section()
    {
        return $this->belongsTo('App\Models\Sections\Section', 'section_id');
    }
}
