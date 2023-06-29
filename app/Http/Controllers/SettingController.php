<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    public function setting(SettingRequest $request) {
        $user = $request->user();
        return view('setting', ['user' => $user]);
    }
    
    public function change(SettingRequest $request){
        $user = $request->user();
        $user->target_weight = round($request->input('target_weight'),1);
        $user->target_fat_per = round($request->input('target_fat'),1);
        $user->age = $request->input('age');
        $user->height = round($request->input('height'),1);
        $user->save();
        return redirect('/setting');
    }

    public function upload(SettingRequest $request) {
        $dir = 'uploads';
        if($request->file('image')){
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/'.$dir, $file_name);
            $user = $request->user();
            $user->avatar = 'storage/'.$dir.'/'.$file_name;
            $user->save();
        }

        return redirect('/setting');
    }


}
