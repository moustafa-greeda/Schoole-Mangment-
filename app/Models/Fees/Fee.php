<?php

namespace App\Models\Fees;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fee extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title'];

    public function grade(){
        return $this->belongsTo('App\Models\Grades\Grade' , 'Grade_id');
    }
    public function classroom(){
        return $this->belongsTo('App\Models\Classroom\Classroom' , 'classroom_id');
    }
}
