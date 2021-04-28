<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function productsBySlug($slug)
    {
        $data = [];
        //ده شايل بيانات القسم
   $data['category'] = Category::where('slug', $slug)->first();
    //ده شايل بيانات المنتجات الي داخل القسم
        if ($data['category'])
            $data['products'] = $data['category']->products;
       // return Product::with('images')->find(4)->photo[0];
        return view('front.products', $data);
    }
}
