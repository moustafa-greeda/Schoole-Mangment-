<?php

namespace App\Http\Controllers\Students\dashboard;

use Illuminate\Http\Request;
use App\Models\Subjects\Subject;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function index(){
        $subjects = Subject::where('Grade_id' , auth()->user()->Grade_id)->get();
        return view('pages.Students.dashboard.Subjects.index' , compact('subjects'));
    }
}
