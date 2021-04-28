<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class HomeController extends Controller
{

    public function home(){
        $data = [];
        $data['sliders'] = Slider::get(['photo']);
        $data['products'] = Product::where('is_active','1')->take(30)->get();
        $data['categories'] = Category::parent()->select('id', 'slug')->with(['childrenCategories' => function ($q) {
            $q->select('id', 'parent_id', 'slug');
            $q->with(['childrenCategories' => function ($qq) {
                $qq->select('id', 'parent_id', 'slug');
            }]);
        }])->get();
        return view('Front.home',$data);
    }
}
