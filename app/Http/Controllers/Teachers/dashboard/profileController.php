<?php

namespace App\Http\Controllers\Teachers\dashboard;

use Illuminate\Http\Request;
use App\Models\Teachers\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    public function index(){
        $information = Teacher::findorfail(auth()->user()->id);
        return view('pages.Teachers.dashboard.profile' , compact('information'));
    }
    
    public function update(Request $request , $id){

        $information = Teacher::findorfail($id);
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
}
