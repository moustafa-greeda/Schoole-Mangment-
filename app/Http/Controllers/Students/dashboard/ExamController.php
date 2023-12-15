<?php

namespace App\Http\Controllers\Students\dashboard;

use Illuminate\Http\Request;
use App\Models\Quizzes\quizze;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = quizze::where('grade_id' , auth()->user()->Grade_id)
        ->where('classroom_id' , auth()->user()->Classroom_id)
        ->where('section_id' , auth()->user()->section_id)->get();
        return view('pages.Students.dashboard.exams.index' , compact('quizzes'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($quizze_id)
    {
        $student_id = auth()->user()->id;
        return view('pages.Students.dashboard.exams.show' , compact('quizze_id' ,'student_id'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
