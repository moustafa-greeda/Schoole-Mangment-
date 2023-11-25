<?php

namespace App\Models\Attendances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function students()
    {
        return $this->belongsTo('App\Models\Students\Student', 'student_id');
    }

    public function grade()
    {
        return $this->belongsTo('App\Models\Grades\Grade' , 'grade_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Sections\Section', 'section_id');
    }
}
