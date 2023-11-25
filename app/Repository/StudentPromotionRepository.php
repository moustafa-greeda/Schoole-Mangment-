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
                    'Grade_id'     => $request->Grade_id_new,
                    'Classroom_id' => $request->Classroom_id_new,
                    'section_id'   => $request->section_id_new,
                    'academic_year'=> $request->academic_year_new,
                ]);
            
                // insert in to promotions
                promotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->Grade_id,
                    'from_classroom'=>$request->Classroom_id,
                    'from_section'=>$request->section_id,
                    'academic_year'=>$request->academic_year,
                    'to_grade'=>$request->Grade_id_new,
                    'to_classroom'=>$request->Classroom_id_new,
                    'to_section'=>$request->section_id_new,
                    'academic_year_new'=>$request->academic_year_new,
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

    // function show promotion
    public function create(){
        $promotions = promotion::all();
        return view('pages.Students.promotion.mangment' , compact('promotions'));
    }
    // function back promotion 
    public function destroy($request){
        
        // DB::beginTransaction();
        try{
            
            // التراجع عن الكل
            if($request->page_id == 1){

                $promotions = promotion::all();

                foreach($promotions as $promotion){

                    //التحديث في جدول الطلاب
                    $ids = explode(',' , $promotion->student_id);
                    Student::whereIn('id' , $ids)->update([
                        'Grade_id' => $promotion->from_grade ,
                        'Classroom_id' => $promotion->from_classroom ,
                        'section_id' => $promotion->from_section ,
                        'academic_year' => $promotion->academic_year ,
                    ]);

                    // حذف جدول الترقيات
                    promotion::truncate();
                    
                }
                // DB::commit();
                return redirect()->back()->with('error' , trans('messages.delete_promotion'));    
            }
            else{
                $promotion = promotion::findorfail($request->id);
                Student::where('id' , $promotion->student_id)->update([
                    'Grade_id' => $promotion->from_grade ,
                    'Classroom_id' => $promotion->from_classroom ,
                    'section_id' => $promotion->from_section ,
                    'academic_year' => $promotion->academic_year ,
                ]);

                promotion::destroy($request->id);
                return redirect()->back()->with('error' , trans('messages.delete_promotion'));    

            }
        }
        catch (\Exception $e) {
            // DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Graduate(){
        $Grades = Grade::all();
        return view('pages.Students.Graduated.create' , compact('Grades'));
    }

}