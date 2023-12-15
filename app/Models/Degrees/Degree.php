<?php

namespace App\Models\Degrees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;
    public function student(){
        return $this->belongsTo('App\Models\Students\Student' , 'student_id');
    }

    public function quizze(){
        return $this->belongsTo('App\Models\Quizzes\quizze' , 'quizze_id');
    }
}
