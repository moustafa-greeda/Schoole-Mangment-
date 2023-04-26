<?php

namespace App\Models\MyParent;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MyParent extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name_Father' , 'Job_Father' , 'Name_Mother' , 'Job_Mother'];
    protected $table = 'my_parents';
    protected $guarded=[];
}
