<?php 
namespace App\Repository;

use App\Models\Grades\Grade;
use App\Models\Students\Student;
use App\Models\Students\promotion;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface{

    function index(){
        $Grades = Grade::all();
        return view('pages.Students.promotion.index' , compact('Grades'));
    }
    function store($request){

        DB::beginTransaction();

        try{
            $students = Student::where('Grade_id' , $request->Grade_id)->where('Classroom_id', $request->Classroom_id)->where('section_id' , $request->section_id)->get();
            
            if($students->count() < 1){
                return redirect()->back()->with('error_promotions' , __(trans('Students_trans.error_not_found_Student')));
            }
            // update in table Student
            foreach($students as $student){
                $ids = explode(',' , $student->id);
                Student::whereIn('id' , $ids)->update([
                    'Grade_id'     => $request->Grade_id,
                    'Classroom_id' => $request->Classroom_id ,
                    'section_id'   => $request->section_id,
                ]);
            
                // insert in to promotions
                promotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->Grade_id,
                    'from_classroom'=>$request->Classroom_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->Grade_id_new,
                    'to_classroom'=>$request->Classroom_id_new,
                    'to_section'=>$request->section_id_new,
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success' , trans('messages.success'));
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}