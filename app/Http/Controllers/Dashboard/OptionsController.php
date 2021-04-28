<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OptionsRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Option;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class OptionsController extends Controller
{
    public function index()
    {
         $options = Option::with(['product' => function ($prod) {
            $prod->select('id');
            } , 'attribute' => function ($attr) {
                $attr->select('id');
            }])->select('id', 'product_id', 'attribute_id', 'price')->paginate(PAGINATION_COUNT);

         return view('dashboard.options.index', compact('options'));
    }


    public function create()
    {
        $data = [];
        //use Scope
        $data['products'] = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();
        return view('dashboard.options.create', $data);
    }

    public function store(OptionsRequest $request)
    {

        try {
            DB::beginTransaction();

            $option = Option::create([
                'product_id' => $request->product_id,
                'attribute_id' => $request->attribute_id,
                'price' => $request->price,
            ]);
            //save translations
            $option->name = $request->name;
            $option->save();


            DB::commit();
            return redirect()->route('admin.options')->with(['success' => __('admin/pages.O-success-add')]);


        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.products')->with(['error' => __('admin/pages.O-exception-add')]);
        }
    }
    public function edit($id)
    {
        $data = [];
        $data['option']= Option::find($id);
        if (!$data['option'])
            return redirect()->route('admin.options')->with(['error' => __('admin/pages.O-error')]);

        //use Scope
        $data['products'] = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();

        return view('dashboard.options.edit',  $data );
    }

    public function update($id, OptionsRequest $request)
    {
        try {
            $option = Option::find($id);
            if (!$option)
                return redirect()->route('admin.options')->with(['error' => __('admin/pages.O-error')]);



            $option->update($request->only(['price','product_id','attribute_id']));

            //save translations
            $option->name = $request->name;
            $option->save();

            return redirect()->route('admin.options')->with(['success' => __('admin/pages.O-success-update')]);
        } catch (\Exception $ex) {

            return redirect()->route('admin.options')->with(['error' => __('admin/pages.O-exception-update')]);
        }

    }


    public function destroy($id)
    {

        try {
            //get specific categories and its translations
            $category = Category::orderBy('id', 'DESC')->find($id);

            if (!$category)
                return redirect()->route('admin.mainCategories')->with(['error' => __('admin/pages.O-error')]);

            $category->translations()->delete();
            $category->delete();

            return redirect()->route('admin.mainCategories')->with(['success' => __('admin/pages.O-success-delete')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.mainCategories')->with(['error' => __('admin/pages.O-exception-delete')]);
        }
    }

}
