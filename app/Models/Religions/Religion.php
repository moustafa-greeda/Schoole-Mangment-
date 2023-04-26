<?php

namespace App\Models\Religions;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Religion extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $fillable = ['Name'];
    public $translatable = ['Name'];

}
