<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{

    public function index()
    {
        $brands=Brand::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.brands.index',compact('brands'));
    }


    public function create()
    {
        return view('dashboard.brands.create');
    }


    public function store(BrandRequest $request)
    {
        try {

            DB::beginTransaction();
            //validation
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $fileName = "";
            if ($request->has('photo')) {

                $fileName = uploadImage('brands', $request->photo);
            }
            $brands = Brand::create($request->except('_token','photo'));
            //save translations
            $brands->name = $request->name;
            $brands->photo =$fileName;
            $brands->save();

            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => __('admin/brand.success-add')]);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.brands')->with(['error' => __('admin/brand.exception-add')]);
        }

    }


    public function edit($id)
    {
        $brand = Brand::find($id);
        if (!$brand)
            return redirect()->route('admin.brands')->with(['error' => __('admin/brand.error')]);
        return view('dashboard.brands.edit', compact('brand'));

    }


    public function update(BrandRequest $request, $id)
    {
        try {

            $brand=Brand::find($id);
            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' => __('admin/brand.error')]);

            DB::beginTransaction();
            if($request->has('photo')){
                $fileName=uploadImage('brands',$request->photo);
                Brand::where('id',$id)->update(['photo'=>$fileName]);
            }

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $brand->update($request->except('id','photo','_token'));

            //save translations
            $brand->name = $request->name;
            $brand->save();

            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => __('admin/brand.success-update')]);

        }


        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.brands')->with(['error' => __('admin/brand.exception-update')]);

        }
    }

    public function destroy($id)
    {
        try {
            $brand = Brand::find($id);
            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' =>__('admin/brand.error')]);
            DB::beginTransaction();
                $brand->translations()->delete();
                $brand->delete();
            Db::commit();
            return redirect()->route('admin.brands')->with(['success' =>__('admin/brand.success-delete')]);

        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.brands')->with(['error' => __('admin/brand.exception-delete')]);
        }
    }
}
