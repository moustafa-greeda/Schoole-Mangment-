<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Download_AttchController extends Controller
{
    public function downloadAttachment($filename)
    {

        return response()->download(public_path('attachments/Library/'.$filename));
    }
}
