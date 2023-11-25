<?php 

namespace App\Repository;

use App\Models\Grades\Grade;
use App\Models\Quizzes\quizze;
use App\Models\Subjects\Subject;
use App\Models\Teachers\Teacher;

class ExamRepository implements ExamRepositoryInterface{

    public function index(){
        $quizzes = quizze::get();
        return view('pages.Quizzes.index' , compact('quizzes'));
    }

    public function create(){
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.Quizzes.create', $data);
    }

    public function store($request){
        try{
            $quizzes = new quizze();
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = $request->teacher_id;
            $quizzes->save();

            return redirect()->back()->with('success' , trans('messages.success'));

        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id){
        $quizz = Quizze::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.Quizzes.edit', $data, compact('quizz'));
    }

    public function update($request){
        try{
            $quizz = quizze::findorFail($request->id);

            $quizz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = $request->teacher_id;
            $quizz->save();
            return redirect()->route('Quizzes.index')->with('success' , trans('messages.Update'));

        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request){
        try {
            quizze::destroy($request->id);
            return redirect()->back()->with('error' , trans('messages.Delete'));
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}