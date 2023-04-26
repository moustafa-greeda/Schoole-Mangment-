<?php

namespace App\Repository;

interface TeacherRepositoryInterface{

    public function getAllTeachers();
    public function get_All_Specializations();
    public function get_All_Genders();
    public function Store_Teachers($request);
    public function editTeachers($id);
    public function UpdateTeachers($request);
    public function DeleteTeachers($request);
}