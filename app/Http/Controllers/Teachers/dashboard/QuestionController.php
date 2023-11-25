<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Models\Grades\Grade;

use Illuminate\Http\Request;
use App\Models\Quizzes\quizze;
use App\Models\Subjects\Subject;
use App\Models\Questions\Question;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function store(Request $request){
        try {
            $question = new Question();
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizze_id = $request->quizz_id;
            $question->save();

            return redirect()->back()->with('success' , trans('messages.success'));

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $quizz_id = $id;
        return view('pages.Teachers.dashboard.Questions.create', compact('quizz_id'));
    }

    public function edit($id){
        $question = Question::findorFail($id);
        return view('pages.Teachers.dashboard.Questions.edit', compact('question'));
    }
    public function update(Request $request , $id){
        try {
            $question = Question::findorfail($id);
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->save();

            return redirect()->back()->with('success' , trans('messages.Update'));

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id){
        try {
            Question::destroy($id);
            return redirect()->back()->with('error' , trans('messages.Delete'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
