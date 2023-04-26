<?php

namespace App\Models\Nationalities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nationalitie extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $fillable = ['Name'];
    public $translatable = ['Name'];
}
