<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{
    public function uploadFile($request,$name,$folder)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/',$folder.'/'.$file_name,'upload_attachment');

    }

    public function deleteFile($name)
    {
        $exists = Storage::disk('upload_attachment')->exists('attachments/Library/'.$name);

        if($exists)
        {
            Storage::disk('upload_attachments')->delete('attachments/Library/'.$name);
        }
    }
}