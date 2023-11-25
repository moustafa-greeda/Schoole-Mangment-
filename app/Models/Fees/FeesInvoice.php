<?php

namespace App\Models\Fees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesInvoice extends Model
{
    use HasFactory;
    protected $guarded =[];

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

    public function student()
    {
        return $this->belongsTo('App\Models\Students\Student', 'student_id');
    }

    public function fees()
    {
        return $this->belongsTo('App\Models\Fees\Fee', 'fee_id');
    }

}
