<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Http\Requests\Admin\tagsRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{

    public function index()
    {
        $tags=Tag::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.tags.index',compact('tags'));
    }


    public function create()
    {
        return view('dashboard.tags.create');
    }

    public function store(tagsRequest $request)
    {
        try {

            DB::beginTransaction();

            //validation
            $tags = Tag::create(['slug'=>$request->slug]);

            //save translations
            $tags->name = $request->name;
            $tags->save();
            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => __('admin/pages.success-add')]);


        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.tags')->with(['error' => __('admin/brand.exception-add')]);
        }

    }


    public function edit($id)
    {

        $tag = Tag::find($id);
        if (!$tag)
            return redirect()->route('admin.tags')->with(['error' => __('admin/pages.error')]);

        return view('dashboard.tags.edit', compact('tag'));

    }


    public function update(tagsRequest $request, $id)
    {
        try {

            $tag=Tag::find($id);
            if (!$tag)
                return redirect()->route('admin.tags')->with(['error' =>__('admin/pages.error')]);
            DB::beginTransaction();

            $tag->update($request->except('id','_token')); //update only slug colum

            //save translations
            $tag->name = $request->name;
            $tag->save();

            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => __('admin/pages.success-update')]);

        }


        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.tags')->with(['error' => __('admin/pages.exception-update')]);

        }
    }

    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $tag = Tag::find($id);

            if (!$tag)
                return redirect()->route('admin.tags')->with(['error' =>__('admin/pages.error')]);

            $tag->delete();

            return redirect()->route('admin.tags')->with(['success' => __('admin/pages.success-delete')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.tags')->with(['error' => __('admin/pages.exception-delete')]);
        }
    }
}
