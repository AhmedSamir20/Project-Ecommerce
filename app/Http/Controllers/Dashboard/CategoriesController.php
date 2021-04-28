<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\Admin\CategoryRequest;

use App\Models\Category;
use Illuminate\Support\Facades\DB;


class CategoriesController extends Controller
{
    public function index()
    {
        //use scope
        //$categories = Category::parent()->orderBy('id','DESC') -> paginate(PAGINATION_COUNT);
        $categories = Category::with('_parent')
            ->orderBy('id', 'DESC')
            ->paginate(PAGINATION_COUNT);

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::select('id', 'parent_id')->get();
        return view('dashboard.categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        try {

            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            //if user choose main category then we must remove parent id from the request

            if ($request->type == CategoryType::mainCategory) //main Category
            {
                $request->request->add(['parent_id' => null]);
            }

            //if choose child category we must add parent id
            $category = Category::create($request->except('_token'));

            //save translations
            $category->name = $request->name;
            $category->save();
            DB::commit();
               return redirect()
                ->route('admin.mainCategories')
                ->with(['success' =>  __('admin/category.success-add')]);


        } catch (\Exception $ex) {
            DB::rollback();
                return redirect()
                ->route('admin.mainCategories')
                ->with(['error' =>  __('admin/category.exception-add')]);
        }

    }


    public function edit($id)
    {
        $categories = Category::find($id);

        if (!$categories)
               return redirect()
                ->route('admin.mainCategories')
                ->with(['error' => __('admin/category.error')]);


        //As you can see, we’re loading only parent categories, with children as relationships.
        $mainCategories = Category::parent()
            ->with('childrenCategories')
            ->orderBy('id','DESC')
            ->get();

        return view('dashboard.categories.edit', compact('categories','mainCategories'));
    }




    public function updateCategory($id, CategoryRequest $request)
    {


        $category = Category::find($id);
        if (!$category)
            return redirect()->route('admin.mainCategories')->with(['error' => __('admin/category.error')]);

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);

        DB::beginTransaction();
//==================== Enumerations; ====================
        if ($request->type == CategoryType::mainCategory) {

            $category->update([
                'slug' => $request->slug,
                'is_active' => $request->is_active,
            ]);


            $category->name = $request->name;
            $category->save();

            DB::commit();

            return redirect()->route('admin.mainCategories')->with(['success' => __('admin/category.success-update')]);
        }else {
            DB::beginTransaction();
            $category->update([
                'slug' => $request->slug,
                'parent_id' => $request->parent_id,
                'is_active' => $request->is_active,
            ]);


            $category->name = $request->name;
            $category->save();

            DB::commit();

            return redirect()->route('admin.mainCategories')->with('success', __('admin/category.success-update'));
        }
    }

    public function destroy($id)
    {

        try {
            //get specific categories and its translations
            $category = Category::orderBy('id', 'DESC')->find($id);

            if (!$category)
                return redirect()->route('admin.mainCategories')->with(['error' => __('admin/category.error')]);

            $category->translations()->delete();
            $category->delete();

            return redirect()->route('admin.mainCategories')->with(['success' => __('admin/category.success-delete')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.mainCategories')->with(['error' => __('admin/category.exception-delete')]);
        }
    }

}
