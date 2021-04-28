<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributeRequest;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AttributesController extends Controller


{

    public function index()
    {
        $attributes=Attribute::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.attributes.index',compact('attributes'));
    }


    public function create()
    {
        return view('dashboard.attributes.create');
    }


    public function store(AttributeRequest $request)
    {
        try {

            DB::beginTransaction();
            //validation


            $attribute = Attribute::create([]);

            //save translations
            $attribute->name = $request->name;
            $attribute->save();

            DB::commit();
            return redirect()->route('admin.attributes')->with(['success' => __('admin/pages.P-success-add')]);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.attributes')->with(['error' =>  __('admin/pages.P-exception-add-add')]);
        }

    }


    public function edit($id)
    {

        $attribute = Attribute::find($id);

        if (!$attribute)
            return redirect()->route('admin.attributes')->with(['error' =>  __('admin/pages.P-error')]);

        return view('dashboard.attributes.edit', compact('attribute'));

    }


    public function update(AttributeRequest $request, $id)
    {
        try {

            $attribute=Attribute::find($id);
            if (!$attribute)
                return redirect()->route('admin.attributes')->with(['error' =>  __('admin/pages.P-error')]);

            DB::beginTransaction();

            //save translations
            $attribute->name = $request->name;
            $attribute->save();

            DB::commit();
            return redirect()->route('admin.attributes')->with(['success' =>  __('admin/pages.P-success-update')]);

        }


        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.brands')->with(['error' =>  __('admin/pages.P-exception-update')]);

        }
    }

    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $brand = Brand::find($id);

            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' =>  __('admin/pages.P-error')]);
            $brand->delete();

            return redirect()->route('admin.brands')->with(['success' =>  __('admin/pages.P-success-delete')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.brands')->with(['error' => __('admin/pages.P-exception-delete')]);
        }
    }
}
