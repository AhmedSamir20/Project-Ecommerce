<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShippingsRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function editShippingMethods($type)
    {

        /****free--inner--outer for shipping methods*****/
        if ($type === 'free')
            $shippingMethod  = Setting::where('key', 'free_shipping_label')->first();

        elseif ($type === 'inner')
            $shippingMethod  = Setting::where('key', 'local_label')->first();

        elseif ($type === 'outer')
            $shippingMethod  = Setting::where('key', 'outer_label')->first();

        else
            $shippingMethod  = Setting::where('key', 'free_shipping_label')->first();

        return view('dashboard.settings.shipping.edit',compact('shippingMethod')) ;
    }


    public function updateShippingMethods(ShippingsRequest $request,$id){

        try {

            $shipping_methods=Setting::find($id);
            DB::beginTransaction();
            $shipping_methods->update(['plan_value'=>$request->plan_value]);

            //save translate
            $shipping_methods-> value = $request -> value;
            $shipping_methods->save();

            DB::commit();
            return redirect()->back()->with(['success' => __('admin/shipping.success')]);
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error' => __('admin/shipping.error')]);
        }


    }
}
