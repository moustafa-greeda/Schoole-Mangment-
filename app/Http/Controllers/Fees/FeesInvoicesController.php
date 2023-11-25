<?php

namespace App\Http\Controllers\Fees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\FeesInvoicesRepositoryInterface;

class FeesInvoicesController extends Controller
{
    protected $Fees_Invoices;
    public function __construct(FeesInvoicesRepositoryInterface $Fees_Invoices){
        $this->Fees_Invoices = $Fees_Invoices;
    }

    public function index()
    {
        return $this->Fees_Invoices->index();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->Fees_Invoices->store($request);
    }

    public function show($id)
    {
        return $this->Fees_Invoices->show($id);
    }

    public function edit($id)
    {
        return $this->Fees_Invoices->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Fees_Invoices->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Fees_Invoices->destroy($request);
    }
}
