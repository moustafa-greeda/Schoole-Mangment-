<?php 
namespace App\Repository;

use App\Models\Grades\Grade;
use App\Models\Students\Student;

class StudentGraduatedRepositry implements StudentGraduatedRepositryInterface{
    
    //  public function create
    public function create(){
        $Grades = Grade::all();
        return view('pages.Students.Graduated.create' , compact('Grades'));
    }

    //  public function index
    public function index(){
        $students = Student::onlyTrashed()->get();
        return view('pages.Students.Graduated.index' , compact('students'));
    }

    //  public function SoftDelete
    public function SoftDelete($request)
    {
        $students = student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();

        if($students->count() < 1){
            return redirect()->back()->with('error_Graduated' , __(trans('Students_trans.error_not_found_Student')));
        }

        foreach ($students as $student){
            $ids = explode(',',$student->id);
            Student::whereIn('id', $ids)->Delete();
        }
        return redirect()->back()->with('success' , trans('messages.success'));
    }
    
    //  public function ReturnData
    public function ReturnData($request)
    {
        Student::onlyTrashed()->where('id' , $request->id)->first()->restore();
        return redirect()->back()->with('success' , trans('messages.success'));
    }

    //  public function destroy
    public function destroy($request){

        Student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
        return redirect()->back()->with('error', trans('messages.Delete'));
    }
}