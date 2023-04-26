<?php

namespace App\Http\Controllers\Grades;

use App\Models\Grades\Grade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGrades;
use App\Models\Classroom\Classroom;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
  public function index()
  {
    toastr()->success('Success Message');
    $Grades= Grade::all();
    toastr()->success('Success Message');
    return view('pages.Grades.Grades' , compact('Grades'));
  }

  public function create()
  {

  }

  public function store(StoreGrades $request)
  {
    if(Grade::where('Name->en',$request->Name_en)->orWhere('Name->ar',$request->Name)->exists()){
      return redirect()->back()->withErrors(trans('Grades_trans.Exists'));
    }
    try{
      $validated = $request->validated();

      $Grade = new Grade();
      $Grade->Name = ['en'=>$request->Name_en , 'ar'=>$request->Name];
      $Grade->Note = $request->Notes;
      $Grade->save();

      return back()->with('success', trans('messages.success'));


      return redirect()->back()->with('message','Data added Successfully');
    } 
    catch(\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function show($id)
  {

  }
 
  public function update(StoreGrades $request)
  {
    try{
      $validated = $request->validated();
      $Grades    =Grade::findOrFail($request->id);

      $Grades->update([
        $Grades->Name =['en'=>$request->Name_en , 'ar'=>$request->Name],
        $Grades->Note = $request->Notes,
      ]);

      return back()->with('success', trans('messages.Update'));

    }
    catch(\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function destroy(Request $request)
  {
    $Classroom_id = Classroom::where('Grade_id' , $request->id)->pluck('Grade_id');

    if($Classroom_id->count() == 0){

      $Grades = Grade::findOrFail($request->id)->delete();
      return back()->with('error', trans('messages.Delete'));

    }else{
      return back()->with('error', trans('My_Classes_trans.delete_Class_Error'));
    }
  }

}

?>
