<?php

namespace App\Http\Controllers\Teachers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTeacher;
use App\Http\Controllers\Controller;
use App\Repository\TeacherRepositoryInterface;

class TeacherController extends Controller
{
    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    public function index()
    {
        $Teachers = $this->Teacher->getAllTeachers();
        return view('pages.Teachers.Teachers',compact('Teachers'));
    }

    public function create()
    {
        $specializations = $this->Teacher->get_All_Specializations();
        $genders = $this->Teacher->get_All_Genders();
        return view('pages.Teachers.create',compact('specializations','genders'));
    }


    public function store(StoreTeacher $request)
    {
        return $this->Teacher->Store_Teachers($request);
    }

    public function edit($id)
    {
        $Teachers = $this->Teacher->editTeachers($id);
        $specializations = $this->Teacher->get_All_Specializations();
        $genders = $this->Teacher->get_All_Genders();
        return view('pages.Teachers.Edit',compact('Teachers','specializations','genders'));
    }


    public function update(Request $request)
    {
        return $this->Teacher->UpdateTeachers($request);
    }

    public function destroy(Request $request)
    {
        return $this->Teacher->DeleteTeachers($request);
    }
}
