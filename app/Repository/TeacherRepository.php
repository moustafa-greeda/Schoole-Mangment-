<?php

namespace App\Repository;
use App\Models\Genders\Gender;
use App\Models\Teachers\Teacher;
use Illuminate\Support\Facades\Hash;
use App\Models\Specializations\Specialization;

class TeacherRepository implements TeacherRepositoryInterface{

    public function getAllTeachers(){
        return Teacher::all();
    }
    public function get_All_Specializations(){
        return Specialization::all();
    }
    public function get_All_Genders(){
        return Gender::all();
    }
    public function Store_Teachers($request){
        try{
            $Teacher = new Teacher();
            $Teacher->email = $request->Email;
            $Teacher->password = Hash::make($request->Password);
            $Teacher->Name = ['en' => $request->Name_en , 'ar' => $request->Name_ar];
            $Teacher->Specialization_id = $request->Specialization_id;
            $Teacher->Gender_id = $request->Gender_id;
            $Teacher->Joining_Date = $request->Joining_Date;
            $Teacher->Address = $request->Address;
            $Teacher->save();

            return redirect()->route('Teachers.index')->with('success' , trans('messages.success'));


        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // Edit Teachers
    public function editTeachers($id){
        return Teacher::findOrFail($id);
    }
    // Edit Teachers 
    public function UpdateTeachers($request){
        try{
            $Teachers = Teacher::findOrFail($request->id);

            $Teachers->email = $request->Email;
            $Teachers->password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();

            return redirect()->route('Teachers.index')->with('success' , trans('messages.Update'));

        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // Delete Teachers 
    public function DeleteTeachers($request){
        Teacher::findOrFail($request->id)->delete();
        return redirect()->route('Teachers.index')->with('error' , trans('messages.Delete'));
    }

}