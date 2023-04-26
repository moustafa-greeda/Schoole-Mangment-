<?php

namespace App\Models\MyParent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parentAttachment extends Model
{
    use HasFactory;
    protected $fillable=['file_name' , 'parent_id'];
    
}
