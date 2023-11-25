<?php

namespace App\Http\Controllers\Teachers\dashboard;

use Illuminate\Http\Request;
use App\Models\Sections\Section;
use App\Models\Students\Student;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Attendances\Attendance;

class StudentController extends Controller
{

    public function index()
    {
        $ids = DB::table('teacher_section')->where('teacher_id' , auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id' , $ids)->get();
        return view('pages.Teachers.dashboard.Students.index' , compact('students'));
        // return $students;
    }
    public function section(){

        $ids = DB::table('teacher_section')->where('teacher_id' , auth()->user()->id)->pluck('section_id');
        $sections = Section::whereIn('id',$ids)->get();
        return view('pages.Teachers.dashboard.Sections.index' , compact('sections'));
    }
    public function attendance(Request $request){
        try{
            foreach($request->attendences as $studentid => $attendence){

                if($attendence == 'presence'){
                    $attendence_status = true;
                }else if($attendence == 'absent'){
                    $attendence_status = false;
                }

                Attendance::updateorCreate(
                    [
                        'student_id'=> $studentid,
                        'attendence_date'=> date('Y-m-d'),
                    ]
                    ,[
                        'student_id' => $studentid , 
                        'grade_id'   => $request->grade_id,
                        'classroom_id' => $request->classroom_id,
                        'section_id'   => $request->section_id,
                        'teacher_id'   => 1 ,
                        'attendence_date'   => date('Y-m-d'),
                        'attendence_status' => $attendence_status
                    ]
                );
            }
            return redirect()->back()->with('success' , trans('messages.success'));
        } 
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }      
    }

    public function attendanceReport(){
        $ids = DB::table('teacher_section')->where('teacher_id' , auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id' , $ids)->get();
        return view('pages.Teachers.dashboard.Students.attendance_report' , compact('students'));
    }

    public function attendanceSearch(Request $request){

        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to'   => 'required|date|date_format:Y-m-d|after_or_equal:from',
        ],[
            'to.date_format'   => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'from.date_format' =>'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.after_or_equal'=>'تاريخ النهاية لابد ان يكون اكبر من تاريخ البداية او يساويه',
        ]);
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();


        if($request->student_id == 0){
            $Students = Attendance::wherebetween('attendence_date' , [$request->from , $request->to])->get();
            return view('pages.Teachers.dashboard.Students.attendance_report' , compact('Students' , 'students'));
        }
        else{
            $Students = Attendance::wherebetween('attendence_date' , [$request->from , $request->to])
        ->where('student_id' , $request->student_id)->get();
            return view('pages.Teachers.dashboard.Students.attendance_report' , compact('Students' ,'students'));
        }
    }

}
