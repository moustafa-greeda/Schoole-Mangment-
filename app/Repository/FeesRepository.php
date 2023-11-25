<?php 
namespace App\Repository;

use App\Models\Fees\Fee;
use App\Models\Grades\Grade;

class FeesRepository implements FeesRepositoryInterface{
    public function index(){
        $fees = Fee::all();
        return view('pages.Fees.index' , compact('fees'));
    }

    // public function create
    public function create(){
        $Grades = Grade::all();
        return view('pages.Fees.add' , compact('Grades'));
    }
    
    // public function store
    public function store($request){
        try{
            $Fees = new Fee();
            $Fees->title = ['en'=> $request->title_en , 'ar'=>$request->title_ar];
            $Fees->amount  = $request->amount;
            $Fees->Grade_id = $request->Grade_id;
            $Fees->classroom_id = $request->Classroom_id;
            $Fees->Fee_type = $request->Fee_type;
            $Fees->description = $request->description;
            $Fees->year = $request->year;
            
            $Fees->save();
            return redirect()->back()->with('success' , trans('messages.success'));
        }
        catch(\Excption $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //  public function edit
    public function edit($id){
        $fees = Fee::findorfail($id);
        $Grades = Grade::all();
        return view('pages.Fees.edit',compact('fees','Grades'));
    }

    // public function update
    public function update($request){
        try{
            $Fees = Fee::findorfail($request->id);
            $Fees->title = ['en'=> $request->title_en , 'ar'=>$request->title_ar];
            $Fees->amount  = $request->amount;
            $Fees->Grade_id = $request->Grade_id;
            $Fees->classroom_id = $request->Classroom_id;
            $Fees->Fee_type = $request->Fee_type;
            $Fees->description = $request->description;
            $Fees->year = $request->year;
            // $Fees->Fee_type = $request->Fee_type;
            
            $Fees->save();
            return redirect()->route('Fees.index')->with('success' , trans('messages.Update'));
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // public function Delete
    public function destroy($request){
        Fee::findorfail($request->id)->delete();
        return redirect()->route('Fees.index')->with('error', trans('messages.Delete'));

    }


}