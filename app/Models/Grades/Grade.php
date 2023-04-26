<?php

namespace App\Models\Grades;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;
    public $translatable =['Name'];

    protected $table ='grades';
    protected $fillable=['Name' , 'Note'];
    use HasFactory;

    public function Sections(){
        return $this->hasMany('App\Models\Sections\Section' ,'Grade_id');
    }
}
