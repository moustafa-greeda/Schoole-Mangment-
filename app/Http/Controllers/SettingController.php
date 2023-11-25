<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Traits\AttachFilesTrait;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    use AttachFilesTrait;
    public function index(){

        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function($collection){
            return [$collection -> key => $collection -> value];
        });
        return view('pages.Setting.index' , $setting);
    }

    public function update(Request $request){

        try{
            $info = $request->except('_token ', '_method' , 'logo');
            foreach($info as $key => $value){
                Setting::where('key' , $key)->update(['value' => $value]);
            }

            if($request->hasFile('logo')){

                $logo_name = $request->file('logo')->getClientOriginalName();
                Setting::where('key' , 'logo')->update(['value' => $logo_name]);
                
                // $exists = Storage::disk('upload_attachment')->exists('attachments/logo/'.$logo_name);

                // if($exists)
                // {
                //     Storage::disk('upload_attachments')->delete('attachments/logo/'.$logo_name);
                // }

                $this->uploadFile($request , 'logo' , 'logo');
            }

            return redirect()->back()->with('success' , trans('messages.Update'));
        }
        catch (\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}
