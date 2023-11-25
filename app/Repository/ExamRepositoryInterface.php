<?php 
namespace App\Repository;

interface ExamRepositoryInterface { 

 public function index();
 public function create();
 public function edit($id);
 public function update($request);
 public function destroy($request);

}