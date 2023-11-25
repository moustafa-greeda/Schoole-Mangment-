<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sections\Section;
use App\Models\Classroom\Classroom;

class ajaxCodeController extends Controller
{
    // Get Classroom
    public function Get_Classrooms($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        return $list_classes;
    }

    //Get Sections
    public function Get_Sections($id){

        $list_sections = Section::where("Class_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
    }
}
