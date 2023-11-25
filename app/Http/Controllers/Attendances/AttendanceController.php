<?php

namespace App\Http\Controllers\Attendances;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\AttendanceRepositoryInterface;

class AttendanceController extends Controller
{
    protected $Attendace;
    public function __construct(AttendanceRepositoryInterface $Attendace){
        $this->Attendace = $Attendace;
    }
    public function index()
    {
        return $this->Attendace->index();
    }

    public function store(Request $request)
    {
        return $this->Attendace->store($request);
    }

    public function show($id)
    {
        return $this->Attendace->show($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
