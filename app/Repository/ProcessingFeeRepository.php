<?php


namespace App\Repository;


use App\Models\Fees\ProcessingFee;
use App\Models\Students\Student;
use App\Models\Fees\StudentAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{

    public function index()
    {
        $ProcessingFees = ProcessingFee::all();
        return view('pages.ProcessingFee.index',compact('ProcessingFees'));
    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('pages.ProcessingFee.add',compact('student'));
    }

    public function edit($id)
    {
        $ProcessingFee = ProcessingFee::findorfail($id);
        return view('pages.ProcessingFee.edit',compact('ProcessingFee'));
    }

    // public function store
    public function store($request){
        DB::beginTransaction();
        try{
            // insert in table ProcessingFee
            $ProcessingFee = new ProcessingFee();
            $ProcessingFee->date = date('Y-m-d') ;
            $ProcessingFee->student_id = $request->student_id ;
            $ProcessingFee->amount = $request->Debit ;
            $ProcessingFee->description = $request->description ;
            $ProcessingFee->save();

            // insert in table student_accounts
            $Student_accounts = new StudentAccount();
            $Student_accounts->date = date('Y-m-d');
            $Student_accounts->type = 'processing_fees';
            $Student_accounts->student_id = $request->student_id;
            $Student_accounts->processing_id = $ProcessingFee->id;
            $Student_accounts->Debit = 0.00;
            $Student_accounts->credit = $request->Debit;
            $Student_accounts->description = $request->description;
            $Student_accounts->save();

            DB::commit();
            return redirect()->route('Students.index')->with('success' , trans('messages.success'));
        
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withError(['error' => $e->getMessage()]);
        }
    }

    //   public function update
    public function update($request)
    {
        DB::beginTransaction();

        try {
            // تعديل البيانات في جدول معالجة الرسوم
            $ProcessingFee = ProcessingFee::findorfail($request->id);
            $ProcessingFee->date = date('Y-m-d');
            $ProcessingFee->student_id = $request->student_id;
            $ProcessingFee->amount = $request->Debit;
            $ProcessingFee->description = $request->description;
            $ProcessingFee->save();

            // تعديل البيانات في جدول حساب الطلاب
            $students_accounts = StudentAccount::where('processing_id' , $request->id)->first();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'ProcessingFee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $ProcessingFee->id;
            $students_accounts->Debit = 0.00;
            $students_accounts->credit = $request->Debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();
            return redirect()->route('ProcessingFee.index')->with('success' , trans('messages.Update'));

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // public function destroy
    public function destroy($request)
    {
        try {
            ProcessingFee::destroy($request->id);
            return redirect()->route('ProcessingFee.index')->with('error', trans('messages.Delete'));
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}