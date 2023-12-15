<?php

namespace App\Http\Controllers\Parents\dashboard;

use Illuminate\Http\Request;
use App\Models\Degrees\Degree;
use App\Models\Fees\FeesInvoice;
use App\Models\Students\Student;
use App\Models\MyParent\MyParent;
use Illuminate\Support\Facades\DB;
use App\Models\Fees\ReceiptStudent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Attendances\Attendance;

class ChildernController extends Controller
{
    public function index(){
        $students = Student::where('parent_id' , auth()->user()->id)->get();
        return view('pages.Parents.Children.index' , compact('students'));
    }
    
    public function children_result($id){
        $students = Student::findorFail($id);
        if($students->parent_id !== auth()->user()->id){
            return redirect()->route('sons.index')->with('error' , trans('messages.warm_parent'));        
        }
        
        $degrees = Degree::where('student_id' , $id)->get();
        if($degrees->isEmpty()){
            return redirect()->route('sons.index')->with('error' , trans('messages.warm_parent_degree'));        
        }
        return view('pages.Parents.Degrees.index', compact('degrees'));
        
    }

    public function children_attendance(){
        $students = Student::where('parent_id' , auth()->user()->id)->get();
        return view('pages.Parents.Attendance.index' , compact('students'));
    }
    public function childern_attendanceSearch(Request $request){

        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to'   => 'required|date|date_format:Y-m-d|after_or_equal:from',
        ],[
            'to.date_format'   => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'from.date_format' =>'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.after_or_equal'=>'تاريخ النهاية لابد ان يكون اكبر من تاريخ البداية او يساويه',
        ]);
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();


        if($request->student_id == 0){
            $Students = Attendance::wherebetween('attendence_date' , [$request->from , $request->to])->get();
            return view('pages.Parents.Attendance.attendance_report' , compact('Students' , 'students'));
        }
        else{
            $Students = Attendance::wherebetween('attendence_date' , [$request->from , $request->to])
        ->where('student_id' , $request->student_id)->get();
            return view('pages.Parents.Attendance.attendance_report' , compact('Students' ,'students'));
        }
    }

    public function fees_invoices(){
        $student_ids = Student::where('parent_id' , auth()->user()->id)->pluck('id');
        $Fee_invoices = FeesInvoice::whereIn('student_id' , $student_ids)->get();
        return view('pages.Parents.Fees.index', compact('Fee_invoices'));
    }

    public function receiptStudent($id){
        $students = Student::findorFail($id);
        if($students->parent_id !== auth()->user()->id){
            return redirect()->route('sons.invoices')->with('error' , trans('messages.warm_parent'));        
        }

        $receipt_students = ReceiptStudent::where('student_id' , $id)->get();
        if ($receipt_students->isEmpty()) {
            return redirect()->route('sons.index')->with('error' , trans('messages.warm_parent_receipt')); 
        }
        return view('pages.Parents.Fees.Receipt', compact('receipt_students'));
    }

    public function profile()
    {
        $information = MyParent::findorFail(auth()->user()->id);
        return view('pages.Parents.profile', compact('information'));
    }

    public function update(Request $request, $id)
    {

        $information = MyParent::findorFail($id);

        if (!empty($request->password)) {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        return redirect()->back()->with('success' , trans('messages.Update'));
    }


}
