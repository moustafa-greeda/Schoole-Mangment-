<?php

namespace App\Http\Controllers\Students;

use App\Models\Images\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\StudentRepositoryInterface;

class StudentController extends Controller
{
    protected $Student;
    public function __construct(StudentRepositoryInterface $Student){
        $this->Student =$Student;
    }
    public function index()
    {
        return $this->Student->List_Student();
    }

    public function create()
    {
        return $this->Student->Create_Student();
    }

    public function store(Request $request)
    {
        return $this->Student->Store_Student($request);
    }

    public function show($id)
    {
        return $this->Student->Show_Student($id);
    }

    public function edit($id)
    {
        return $this->Student->edit_Student($id);
    }

    public function update(Request $request)
    {
        return $this->Student->Update_Student($request);
    }

    public function destroy(Request $request)
    {
        return $this->Student->Delete_Student($request);
    }

    public function Get_classrooms($id)
    {
       return $this->Student->Get_classrooms($id);
    }

    public function Get_Sections($id)
    {
        return $this->Student->Get_Sections($id);
    }
    public function upload_attachment(Request $request){
        return $this->Student->upload_attachment($request);
    }
    public function Download_Attachment($student_name , $file_name){
        return $this->Student->Download_Attachment($student_name,$file_name);
    }
    public function Delete_Attachment(Request $request){
        return $this->Student->Delete_Attachment($request);
    }
}
