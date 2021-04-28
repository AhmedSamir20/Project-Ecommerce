<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Admin;


class ProfileController extends Controller
{
    public function editProfile(){

        $id =auth('admin')->user()->id;
         $admin= Admin::findOrFail($id);
         return view('Dashboard.Profile.edit',compact('admin'));

    }
    public function updateProfile(ProfileRequest $request){

        //validation Request

        try {
            $admin= Admin::find( auth('admin')->user()->id);
            if ($request->filled('password')){
                 $request->merge(['password'=>bcrypt($request->password)]);
            }
            unset($request['id']);
            unset($request['password_confirmation']);

            $admin->update($request->all());
            return redirect()->back()->with(['success' => __('admin/editProfile.success')]);
        }
        catch (\Exception $e){
            return redirect()->back()->with(['error' => __('admin/editProfile.error')]);

        }

    }


}
