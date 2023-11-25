<?php 
namespace App\Repository;

use App\Models\Fees\Fee;
use App\Models\Fees\FeesInvoice;
use App\Models\Students\Student;
use Illuminate\Support\Facades\DB;
use App\Models\Fees\StudentAccount;

class FeesInvoicesRepository implements FeesInvoicesRepositoryInterface{
    public function show($id){
        $student = Student::findorfail($id);
        $fees    = Fee::all();
        return view('pages.Fees_Invoices.add' , compact('student' , 'fees'));
    }

    // public function store($request);
    public function store($request){

        DB::beginTransaction();
        $List_Fees = $request->List_Fees;

        try{
            // insert in table Fees_Invoices
            foreach($List_Fees as $List_Fee){
                $Fee = new FeesInvoice();

                $Fee->invoice_date = date('Y-m-d');
                $Fee->student_id = $List_Fee['student_id'];
                $Fee->Grade_id = $request->Grade_id;
                $Fee->Classroom_id = $request->Classroom_id;
                $Fee->fee_id = $List_Fee['fee_id'];
                $Fee->amount = $List_Fee['amount'];
                $Fee->description = $List_Fee['description'];
                $Fee->save();

                // insert date in table student account
                $Student_Account = new StudentAccount();
                
                $Student_Account->date = date('Y-m-d');
                $Student_Account->type = 'invoice';
                $Student_Account->student_id     = $List_Fee['student_id'];
                $Student_Account->fee_invoice_id = $Fee->id;
                $Student_Account->Debit  = $List_Fee['amount'];
                $Student_Account->credit = 0.00;
                $Student_Account->description = $List_Fee['description'];
                $Student_Account->save();

            }

            DB::commit();
            return redirect()->back()->with('success' , trans('messages.success'));
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // public function index
    public function index(){
        $Fee_invoices = FeesInvoice::all();
        return view('pages.Fees_Invoices.index' ,compact('Fee_invoices'));
    }

    // public function edit
    public function edit($id){
        $fee_invoices = FeesInvoice::findorfail($id);
        $fees = Fee::where('classroom_id' , $fee_invoices->Classroom_id)->get();
        return view('pages.Fees_Invoices.edit' , compact('fee_invoices' , 'fees'));
    }

    // public function update
    public function update($request)
    {
        DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $Fees = FeesInvoice::findorfail($request->id);
            $Fees->fee_id = $request->fee_id;
            $Fees->amount = $request->amount;
            $Fees->description = $request->description;
            $Fees->save();

            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = StudentAccount::where('fee_invoice_id',$request->id)->first();
            $StudentAccount->Debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();
            DB::commit();

            return redirect()->route('Fees_Invoices.index')->with(trans('messages.Update'));
        } 
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // public function destroy
    public function destroy($request)
    {
        try {
            FeesInvoice::destroy($request->id);
            return redirect()->back()->with('error' , trans('messages.Delete'));
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



}