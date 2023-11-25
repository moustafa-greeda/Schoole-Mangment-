<?php

namespace App\Http\Controllers\Fees;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFees;
use App\Http\Controllers\Controller;
use App\Repository\FeesRepositoryInterface;

class FeesController extends Controller
{

    protected $Fees;
    public function __construct(FeesRepositoryInterface $Fees){
        $this->Fees= $Fees;
    }

    public function index()
    {
        return $this->Fees->index();
    }

    public function create()
    {
        return $this->Fees->create();
    }

    public function store(StoreFees $request)
    {
        return $this->Fees->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->Fees->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Fees->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Fees->destroy($request);
    }
}
