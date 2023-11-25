<?php 
namespace App\Repository;

interface StudentGraduatedRepositryInterface{

    public function create();
    public function index();
    public function SoftDelete($request);
    public function ReturnData($request);
    public function destroy($request);


}