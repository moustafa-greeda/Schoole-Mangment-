<?php

namespace App\Http\Controllers\Students\dashboard;

use Illuminate\Http\Request;
use App\Models\Students\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    public function index()
    {
        $information = Student::findOrfail(auth()->user()->id);
        return view('pages.Students.dashboard.profile' , compact('information'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $information = Student::findorfail($id);
        if(!empty($request->password)){
            $information->Name = ['en'=>$request->Name_en , 'ar'=>$request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        }else{
            $information->Name =['en'=>$request->Name_en , 'ar'=>$request->Name_ar];
            $information->save();
        }
        return redirect()->back()->with('success' , trans('messages.Update'));

    }

    public function destroy($id)
    {
        //
    }
}
