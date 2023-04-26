<?php

namespace App\Repository;
use App\Models\Grades\Grade;
use App\Models\Images\Image;
use App\Models\Genders\Gender;
use App\Models\Sections\Section;
use App\Models\Students\Student;
use App\Models\MyParent\MyParent;
use Illuminate\Support\Facades\DB;
use App\Models\Classroom\Classroom;
use App\Models\TypeBloods\TypeBlood;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Nationalities\Nationalitie;


class StudentRepository implements StudentRepositoryInterface{

    public function List_Student(){
        $students = Student::all();
        return view('pages.Students.index' , compact('students'));
    }

    public function edit_Student($id){
        $Students = Student::findOrFail($id);
        $data['Grades'] = Grade::all();
        $data['parents'] = MyParent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = TypeBlood::all();
        return view('pages.Students.edit',$data ,compact('Students'));
    }

    public function Update_Student($request)
    {
        try {
            $Edit_Students = Student::findorfail($request->id);
            $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Edit_Students->email = $request->email;
            $Edit_Students->password = Hash::make($request->password);
            $Edit_Students->gender_id = $request->gender_id;
            $Edit_Students->nationalitie_id = $request->nationalitie_id;
            $Edit_Students->blood_id = $request->blood_id;
            $Edit_Students->Date_Birth = $request->Date_Birth;
            $Edit_Students->Grade_id = $request->Grade_id;
            $Edit_Students->Classroom_id = $request->Classroom_id;
            $Edit_Students->section_id = $request->section_id;
            $Edit_Students->parent_id = $request->parent_id;
            $Edit_Students->academic_year = $request->academic_year;
            $Edit_Students->save();
            return redirect()->route('Students.index')->with('success' , trans('messages.Update'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

   public function Create_Student(){

       $data['my_classes'] = Grade::all();
       $data['parents'] = MyParent::all();
       $data['Genders'] = Gender::all();
       $data['nationals'] = Nationalitie::all();
       $data['bloods'] = TypeBlood::all();
       return view('pages.Students.add',$data);

    }

    // Get Classromms
    public function Get_classrooms($id){

        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        return $list_classes;

    }

    //Get Sections
    public function Get_Sections($id){

        $list_sections = Section::where("Class_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
    }

    // Store Students
    public function Store_Student($request){

        DB::beginTransaction();

        try {
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            // insert image
            if($request->hasfile('photos')){
                foreach($request->file('photos') as $file){
                    $name = $file->getClientOriginalName();
                    $file->storeAs('Attachment/Students/'.$students->name , $name , 'upload_attachment');
                    
                    // insert in image_table
                    $images = new Image();
                    $images->file_name = $name;
                    $images->imageable_id = $students->id;
                    $images->imageable_type = 'App\Models\Students\Student';
                    $images->save();
                }
            }
            DB::commit(); // insert data
            return redirect()->route('Students.create')->with('success' , trans('messages.success'));
        }

        catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Delete_Student($request)
    {
        Student::destroy($request->id);
        return redirect()->route('Students.index')->with('error', trans('messages.Delete'));
    }

    public function Show_Student($id){
        $Student = Student::findorfail($id);
        return view('pages.Students.show' , compact('Student'));
    }

    public function upload_attachment($request){
        // insert image
        if($request->hasfile('photos')){
            foreach($request->file('photos') as $file){
                $name = $file->getClientOriginalName();
                $file->storeAs('Attachment/Students/'.$request->student_name , $name , 'upload_attachment');
                
                // insert in image_table
                $images = new Image();
                $images->file_name = $name;
                $images->imageable_id = $request->student_id;
                $images->imageable_type = 'App\Models\Students\Student';
                $images->save();
            }
            return redirect()->route('Students.show' ,$request->student_id)->with('success' , trans('messages.success'));
        }
    }

    public function Download_Attachment($student_name , $file_name){
        return response()->download(public_path('Attachment/Students/'.$student_name.'/'.$file_name));
    }
    public function Delete_Attachment($request){
        // Delete img in server disk
        Storage::disk('upload_attachment')->delete('attachments/Students/'.$request->student_name.'/'.$request->filename);

        // Delete in data
        image::where('id',$request->id)->where('file_name',$request->filename)->delete();

        return redirect()->route('Students.show' ,$request->student_id)->with('error', trans('messages.Delete'));
    }

}