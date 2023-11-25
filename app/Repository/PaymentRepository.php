<?php


namespace App\Repository;

use App\Models\Fees\FundAccount;
use App\Models\Fees\PaymentStudent;
use App\Models\Students\Student;
use App\Models\Fees\StudentAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function index()
    {
        $payment_students = PaymentStudent::all();
        return view('pages.Payment.index',compact('payment_students'));
    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('pages.Payment.add',compact('student'));
    }

    public function edit($id)
    {
        $payment_student = PaymentStudent::findorfail($id);
        return view('pages.Payment.edit',compact('payment_student'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {

            // حفظ البيانات ف جدول Payment_students
            $payment_student = new PaymentStudent();
            $payment_student->date = date('Y-m-d');
            $payment_student->student_id = $request->student_id;
            $payment_student->amount = $request->Debit;
            $payment_student->description = $request->description;
            $payment_student->save();

            // حفظ البيانات ف جدول student_accounts
            $student_account = new StudentAccount();
            $student_account->date = date('Y-m-d');
            $student_account->type = 'payment_student';
            $student_account->student_id = $request->student_id;
            $student_account->payment_id = $payment_student->id;
            $student_account->Debit = $request->Debit;
            $student_account->credit = 0.00;
            $student_account->description = $request->description;
            $student_account->save();

            // حفظ البيانات ف جدول fund_accounts
            $fund_account = new FundAccount();
            $fund_account->date = date('Y-m-d');
            $fund_account->payment_id = $payment_student->id;
            $fund_account->Debit = 0.00;
            $fund_account->credit = $request->Debit;
            $fund_account->description = $request->description;
            $fund_account->save();

            DB::commit();
            return redirect()->route('Payment_students.index')->with('success' , trans('messages.success'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        DB::beginTransaction();

        try {

            // تعديل البيانات في جدول سندات الصرف
            $payment_students = PaymentStudent::findorfail($request->id);
            $payment_students->date = date('Y-m-d');
            $payment_students->student_id = $request->student_id;
            $payment_students->amount = $request->Debit;
            $payment_students->description = $request->description;
            $payment_students->save();


            // حفظ البيانات في جدول الصندوق
            $fund_accounts = FundAccount::where('payment_id',$request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->payment_id = $payment_students->id;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->credit = $request->Debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = StudentAccount::where('payment_id',$request->id)->first();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'payment';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $payment_students->id;
            $students_accounts->Debit = $request->Debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();

            DB::commit();
            return redirect()->route('Payment_students.index')->with('success' , trans('messages.Update'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            PaymentStudent::destroy($request->id);
            return redirect()->route('Payment_students.index')->with('error', trans('messages.Delete'));
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}