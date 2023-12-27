<?php

namespace App\Http\Controllers\Students\dashboard;

use Illuminate\Http\Request;
use App\Models\Librarys\Library;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index(){
        $books = Library::where('Grade_id' , auth()->user()->Grade_id)->get();
        return view('pages.Students.dashboard.library.index' , compact('books'));
    }
}
