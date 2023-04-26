<?php

namespace App\Models\Genders;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gender extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable = ['Name'];
}
