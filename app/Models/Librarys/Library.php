<?php

namespace App\Models\Librarys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class library extends Model
{
    use HasFactory;

    protected $table="library";

    public function grade()
    {
        return $this->belongsTo('App\Models\Grades\Grade', 'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom\Classroom', 'Classroom_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Sections\Section', 'section_id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teachers\Teacher', 'teacher_id');
    }

}
