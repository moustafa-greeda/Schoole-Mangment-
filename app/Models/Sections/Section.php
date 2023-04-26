<?php

namespace App\Models\Sections;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class section extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name_Section'];
    protected $fillable=['Name_Section','Grade_id','Class_id'];

    protected $table = 'sections';

    // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام

    public function My_classs()
    {
        return $this->belongsTo('App\Models\Classroom\Classroom', 'Class_id');
    }
    // علاقة الاقسام مع المعلمين
    public function teachers(){
        return $this->belongsToMany('App\Models\Teachers\Teacher' , 'teacher_section');
    }
}
