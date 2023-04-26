<?php

namespace App\Repository;

interface StudentRepositoryInterface{
    public function List_Student();
    public function edit_Student($id);
    public function Update_Student($request);
    public function Create_Student();
    public function Get_classrooms($id);
    public function Get_Sections($id);
    public function Store_Student($request);
    public function Delete_Student($request);
    public function Show_Student($id);
    public function upload_attachment($request);
    public function Download_Attachment($student_name , $file_name);
    public function Delete_Attachment($request);
}
