<?php

namespace App\Models\Fees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessingFee extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo('App\Models\Students\Student', 'student_id');
    }

}
