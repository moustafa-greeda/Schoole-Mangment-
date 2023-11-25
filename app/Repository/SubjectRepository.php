<?php

namespace App\Repository;

use App\Models\Grades\Grade;
use App\Models\Subjects\Subject;
use App\Models\Teachers\Teacher;


class SubjectRepository implements SubjectRepositoryInterface
{

    public function index()
    {
        $subjects = Subject::get();
        return view('pages.Subjects.index',compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.Subjects.create',compact('grades','teachers'));
    }


    public function store($request)
    {
        try {
            $subjects = new Subject();
            $subjects->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $subjects->grade_id = $request->Grade_id;
            $subjects->classroom_id = $request->Class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();

            return redirect()->back()->with('success' , trans('messages.success'));
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function edit($id){

        $subject =Subject::findorfail($id);
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.Subjects.edit',compact('subject','grades','teachers'));

    }

    public function update($request)
    {
        try {
            $subjects =  Subject::findorfail($request->id);
            $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $subjects->grade_id = $request->Grade_id;
            $subjects->classroom_id = $request->Class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();

            return redirect()->route('Subjects.index')->with('success' , trans('messages.Update'));
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Subject::destroy($request->id);
            return redirect()->back()->with('error' , trans('messages.Delete'));
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}