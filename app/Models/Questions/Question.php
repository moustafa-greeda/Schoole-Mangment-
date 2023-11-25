<?php

namespace App\Models\Questions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function quizze(){
        return $this->belongsTo('App\Models\Quizzes\quizze' , 'quizze_id');
    }
}
