<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Degrees\Degree;
use App\Models\Questions\Question;

class ShowQuestion extends Component
{
    public $quizze_id, $student_id, $data, $counter = 0, $questioncount = 0;

    public function render()
    {
        $this->data = Question::where('quizze_id', $this->quizze_id)->get();
        $this->questioncount = $this->data->count();
        return view('livewire.show-question', ['data']);
    }

    public function nextQuestion($question_id, $score, $answer, $right_answer)
    {
        $stuDegree = Degree::where('student_id' , $this->student_id)
        ->where('quizze_id' , $this->quizze_id)->first();
        // insert
        if($stuDegree == null){
            $degree = new Degree();
            $degree->quizze_id = $this->quizze_id;
            $degree->student_id = $this->student_id;
            $degree->question_id = $question_id;
            if (strcmp(trim($answer), trim($right_answer)) === 0) {
                $degree->score += $score;
            } else {
                $degree->score += 0;
            }
            $degree->date = date('Y-m-d');
            $degree->save();
        }
        else
        {
            // update
            if($stuDegree->question_id >= $this->data[$this->counter]->id){
                $stuDegree->score = 0;
                $stuDegree->abuse = '1';
                $stuDegree->save();
                return redirect()->route('student_exams.index')->with('success' , 'تم الغاء الاختبار بسبب وجود تلاعب في النطام');
            }
            else{
                $stuDegree->question_id = $question_id;
                if(strcmp(trim($answer) , trim($right_answer)) == 0){
                    $stuDegree->score += $score ;
                }else{
                    $stuDegree->score += 0 ;
                }
                $stuDegree->save();
            }
        }

        if($this->counter < $this->questioncount - 1 ){
            $this->counter ++;
        }
        else{
            return redirect()->route('student_exams.index')->with('success' , 'تم اجراء الاختبار بنجاح');
        }

    }

}