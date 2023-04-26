<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
use App\Models\Grades\Grade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClassrooms;


class ClassroomController extends Controller
{
    public function index()
    {
        $Grades = Grade::all();
        $My_Classes =Classroom::all();
        return view('pages.My_Classes.My_Classes' , compact('My_Classes','Grades'));
    }

    public function store(StoreClassrooms $request)
    {
        $List_Classes = $request->List_Classes;
        try{
            foreach($List_Classes as $List_Class){
                $My_Classes = new Classroom();
                $My_Classes->Name_Class = ['en'=>$List_Class['Name_class_en'] , 'ar'=>$List_Class['Name']];
                $My_Classes->Grade_id = $List_Class['Grade_id'];
                $My_Classes->save();
            }
            return back()->with('success', trans('messages.success'));
        }
        catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        try{
            $Classrooms = Classroom::findOrFail($request->id);
            $Classrooms->update([
                $Classrooms->Name_Class = ['en'=>$request->Name_en , 'ar'=>$request->Name],
                $Classrooms->Grade_id   = $request->Grade_id,
            ]);
            return back()->with('success', trans('messages.Update'));
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $Classrooms = Classroom::findOrFail($request->id)->delete();
        return back()->with('error', trans('messages.Delete'));
    }

    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        Classroom::whereIn('id', $delete_all_id)->Delete();
        return back()->with('error', trans('messages.Delete'));
    }


    public function Filter_Classes(Request $request)
    {
        $Grades = Grade::all();
        $Search = Classroom::select('*')->where('Grade_id','=',$request->Grade_id)->get();
        return view('pages.My_Classes.My_Classes',compact('Grades'))->withDetails($Search);

    }
}
