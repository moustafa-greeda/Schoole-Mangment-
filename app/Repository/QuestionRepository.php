<?php

namespace App\Repository;

use App\Models\Quizzes\quizze;
use App\Models\Questions\Question;


class QuestionRepository implements QuestionRepositoryInterface
{

    public function index()
    {
        $questions = Question::get();
        return view('pages.Questions.index', compact('questions'));
    }

    public function create()
    {
        $quizzes = Quizze::get();
        return view('pages.Questions.create',compact('quizzes'));
    }

    public function store($request)
    {
        try {
            $question = new Question();
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizze_id = $request->quizze_id;
            $question->save();

            return redirect()->route('Questions.create')->with('success' , trans('messages.success'));

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $question = Question::findorfail($id);
        $quizzes = quizze::get();
        return view('pages.Questions.edit',compact('question','quizzes'));
    }

    public function update($request)
    {
        try {
            $question = Question::findorfail($request->id);
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizze_id = $request->quizze_id;
            $question->save();

            return redirect()->route('Questions.index')->with('success' , trans('messages.Update'));

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Question::destroy($request->id);
            return redirect()->back()->with('error' , trans('messages.Delete'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}