<?php

namespace App\Models\Classroom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory;
    use HasTranslations;
    
    public $translatable = ['Name_Class'];
    protected $table = 'classrooms';
    public $timestamps = true;
    protected $fillable=['Name_Class','Grade_id'];

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grades\Grade', 'Grade_id');
    }
}
