<?php

namespace App\Http\Controllers\Sections;

use App\Models\Grades\Grade;
use Illuminate\Http\Request;
use App\Models\Sections\Section;
use App\Models\Teachers\Teacher;
use App\Models\Classroom\Classroom;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSections;

class SectionController extends Controller
{

    public function index()
    {
        $Grades      = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        $teachers    = Teacher::all();
        return view('pages.Sections.Sections' , compact('Grades' , 'list_Grades' , 'teachers'));
    }

    public function store(StoreSections $request)
    {
        
    try {

        $validated = $request->validated();
        $Sections = new Section();
  
        $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
        $Sections->Grade_id = $request->Grade_id;
        $Sections->Class_id = $request->Class_id;
        $Sections->Status = 1;
        $Sections->save();
        $Sections->teachers()->attach($request->teacher_id);
        return redirect()->back()->with('success' , trans('messages.success'));
  
    }
  
    catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }

    public function update(StoreSections $request)
    {
  
      try {
        $validated = $request->validated();
        $Sections = Section::findOrFail($request->id);
  
        $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
        $Sections->Grade_id = $request->Grade_id;
        $Sections->Class_id = $request->Class_id;
  
        if(isset($request->Status)) {
          $Sections->Status = 1;
        } else {
          $Sections->Status = 2;
        }
        // update paivot table teacher_section
        if(isset($request->teacher_id)){
            $Sections->teachers()->sync($request->teacher_id);
        }else{
            $Sections->teachers()->sync(array());
        }

        $Sections->save();
    return back()->with('success', trans('messages.Update'));
    }
    catch(\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }

    public function destroy(Request $request)
    {
        Section::findOrFail($request->id)->delete();
        return back()->with('error', trans('messages.Delete'));
    }

    public function getclasses($id){
        $list_classes = Classroom::where('Grade_id' , $id)->pluck( 'Name_Class' , 'id' );
        return $list_classes;
    }
}
