<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\StudentGraduatedRepositryInterface;

class GraduatedController extends Controller
{
    protected $Graduated;
    public function __construct(StudentGraduatedRepositryInterface $Graduated){
        $this->Graduated = $Graduated;
    }
    public function index()
    {
        return $this->Graduated->index();
    }

    public function create()
    {
        return $this->Graduated->create();
    }

    public function store(Request $request)
    {
        return $this->Graduated->SoftDelete($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        return $this->Graduated->ReturnData($request);
    }

    public function destroy(Request $request)
    {
        return $this->Graduated->destroy($request);
    }

}
