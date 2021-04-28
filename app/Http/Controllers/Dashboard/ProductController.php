<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;

use App\Http\Requests\Admin\GeneralProductRequest;
use App\Http\Requests\Admin\ProductImagesRequest;
use App\Http\Requests\Admin\ProductPricesRequest;
use App\Http\Requests\Admin\ProductStockRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Storage;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'slug', 'price', 'is_active','created_at')->paginate(PAGINATION_COUNT);
        return view('dashboard.products.index', compact('products'));
    }

//=========================General information ===================================
    public function create()
    {


        $data = [];
        $data['brand'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        $data['categories'] = Category::active()->select('id')->parent()->with('childrenCategories')->get();

        // return  $data;
        return view('dashboard.products.create.create', compact('data'));

    }

    public function store(Request $request)
    {


        try {
            DB::beginTransaction();
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $product = Product::create([

                'slug' => $request->slug,
                'category_id' => $request->categories,
                'tag_id' => $request->tags,
                'slug' => $request->slug,
                'is_active' => $request->is_active,
                'sku'=>$request->SKU,
                'price'=>$request->price,
                'special_price'=>$request->special_price,
                'special_price_type'=>$request->special_price_type,
                'special_price_start'=>$request->special_price_start,
                'special_price_end'=>$request->special_price_end,
                'manage_stock' => $request->manage_stock,
                'in_stock' => $request->in_stock,
                'qty' => $request->qty,


            ]);
            //save translations
            $product->name = $request->name;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->save();

            //save product categories
            $product->categories()->attach($request->categories);
            $product->tags()->attach($request->tags);

            DB::commit();
            return redirect()->route('index.product')->with(['success' => 'تم ألاضافة بنجاح']);


        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('index.product')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function editProductGeneral($product_id){

        $product_general=Product::with(['categories','tags','brand'])->find($product_id);

        if (!$product_general)
            return redirect()->route('index.product')->with('error','هذا الحقل غير موجود');

            $data=[];
            $data['brand']= Brand::active()->select('id')->get();
            $data['tags']=Tag::select('id')->get();
            $data['categories'] = Category::active()->select('id')->parent()->with('childrenCategories')->get();

            $product_tags=collect();
            foreach ($product_general->tags as$tags ){
                $product_tags[]=$tags;
            }

            $product_categories=collect();
            foreach ($product_general->categories as $mainCategory){
                $product_categories[]=$mainCategory;
            }

    return view('dashboard.products.edit.editProductGeneral',compact('product_general','data','product_tags','product_categories'));
    }


        public  function updateProductGeneral(Request $request ,$product_id){
            try {

                $product_general=Product::with('categories','tags','brand')->find($product_id);
                if(!$product_general)
                    return redirect()->route('index.product')->with('error',__('admin/product.error'));

                if(!$request->has('is_active')){
                    $request->request->add(['is_active',0]);
                }else{
                    $request->request->add(['is_active',1]);
                }
                DB::beginTransaction();
                $product_general->update([
                    'category_id'=>$request->categories,
                    'tag_id'=>$request->tags,
                    'brand_id'=>$request->brand_id,
                    'slug'=>$request->slug,
                    'is_active'=>$request->is_active,

                ]);
                $product_general->name=$request->name;
                $product_general->description=$request->description;
                $product_general->short_description=$request->short_description;
                $product_general->save();

                $product_general->categories()->attach($request->categories);
                $product_general->tags()->attach($request->tags);
                DB::commit();

                return redirect()->route('index.product')->with('success',__('admin/product.success-update-general'));

            }catch (\Exception $e){
                DB::rollBack();
                return redirect()->route('index.product')->with('error',__('admin/product.exception-error'));
            }

    }
//=========================prices===================================


public function editProductPrice($product_id){

    try {

        $product_price=Product::find($product_id);
        if (!$product_price)
            return redirect()->route('index.product')->with('error',__('admin/product.error'));

        return view('dashboard.products.edit.editProductPrice',compact('product_price'));
    }
    catch (\Exception $e){
        return redirect()->route('index.product')->with('error',__('admin/product.exception-error'));
    }

}

public function updateProductPrice(Request  $request,$product_id){

    try {
        $product_price=Product::find($product_id)->first();
        if(!$product_price)
            return redirect()->route('index.product')->with('error',__('admin/product.error'));
        DB::beginTransaction();
        $product_price->update([
            'price'=>$request->price,
            'special_price'=>$request->special_price,
            'special_price_type'=>$request->special_price_type,
            'special_price_start'=>$request->special_price_start,
            'special_price_end'=>$request->special_price_end,
        ]);
        DB::commit();
        return redirect()->route('index.product')->with('success',__('admin/product.success-update-price'));
    }
    catch (\Exception $e){
        DB::rollBack();
        return redirect()->route('index.product')->with('error',__('admin/product. exception-error'));
    }
}

//=========================Stock===================================
    public function editProductStore($product_id){

        try {
            $product_store=Product::find($product_id);
            if (!$product_store)
                return redirect()->route('index.product')->with('error',__('admin/product.error'));
            return view('dashboard.products.edit.editProductStore',compact('product_store'));

        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('index.product')->with('error',__('admin/product. exception-error'));
        }

    }

    public function updateProductStore(Request $request,$product_id){
        try {
            $product_store=Product::find($product_id);
            if (!$product_store)
                return redirect()->route('index.product')->with('error',__('admin/product.error'));

            DB::beginTransaction();
            $product_store->update([$request->except('_token')]);
            DB::commit();
            return redirect()->route('index.product')->with('success', __('admin/product.success-update-stock'));
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('index.product')->with('error',__('admin/product. exception-error'));
        }

    }

    public function addProductImages($product_id){
        $product=Product::with('images')->find($product_id);

        return view('dashboard.products.images.addImages', compact('product'));

    }

    public function saveImagesOfProductInDB(Request $request)
    {
        try {
            if ($request->has('images') && count($request->images) > 0) {
                foreach ($request->images as $image) {
                    Image::create([
                        'imageable_id' => $request->product_id,
                        'imageable_type' => 'App\Models\Product',
                        'photo' => $image
                    ]);
                }
            }

            return redirect()->route('index.product')->with('success', 'تمت اضافة صور المنتج بنجاح');
        } catch (\Exception $ex) {
            return redirect()->route('add.product.images')->with('error', 'هناك حطأ ما يرجى المحاولة مرة أخرى');
        }

    }



    public function saveImagesOfProductInFolder(Request $request)
    {
        try {
            $image = $request->file('dzfile');
            $fileName = uploadImage('products', $image);

            return response()->json([
                'name' => $fileName,
                'original_name' => $image->getClientOriginalName(),
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'msg' => 'فشلت عملية لبحفظ يرجى المحاولة مرة اخرى'
            ]);
        }
    }
    public  function deleteImagesOfProduct($id){

        try {
            $product_image = Image::find($id);
                if (!$product_image)
                    return redirect()->route('index.product')->with('error',__('admin/product.error'));

            DB::beginTransaction();
                $path = public_path('assets/images/products/').''.basename($product_image->photo);
                unlink($path);
                $product_image->delete();
            DB::commit();
            return redirect()->route('index.product')->with('success','Image was deleted successfuly');
        }

        catch (\Exception $e)
                {
                    DB::rollBack();
                    return redirect()->route('index.product')->with('error',__('admin/product. exception-error'));
                }
            }


    public function removeImagesOfProductFromFolder(Request $request){
            $fileName  = $request->input('fileName');
            if(isset($fileName) && !empty($fileName)){
                if(Storage::disk('products')->exists($fileName))
                    Storage::disk('products')->delete($fileName);
            }

    }


//=========================delete product ===================================

    public function destroy($product_id){

        try
        {
            $product=Product::find($product_id);
            if(!$product)
                return redirect()->route('index.product')->with('error',__('admin/product.error'));
            DB::beginTransaction();
            $product->delete();
             DB::commit();
            return redirect()->route('index.product')->with('success',__('admin/product.success-delete-product'));
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('index.product')->with('error',__('admin/product. exception-error'));
        }
    }















    public function getPrice($product_id)
    {
        return view('dashboard.products.prices.create')->with('id', $product_id);
    }

    public function saveProductPrice(ProductPricesRequest $request)
    {
        try {

            Product::whereId($request->product_id)->update($request->only(['price', 'special_price', 'special_price_type', 'special_price_start', 'special_price_end']));
            return redirect()->route('admin.products')->with(['success' => 'تم ألتحديث بنجاح']);

        } catch (\Exception $e) {

            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }

    //=========================inventory===================================

    public function getStock($product_id)
    {
        return view('dashboard.products.stock.create')->with('id', $product_id);
    }

    public function saveProductStock(ProductStockRequest $request)
    {
        try {

            Product::whereId($request->product_id)->update($request->except(['_token', 'product_id']));
            return redirect()->route('admin.products')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $e) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }

    }

    //========================= Images Product===================================
    public function addImages($product_id)
    {
        return view('dashboard.products.images.create')->withId($product_id);

    }

    //save Image to folder only
    public function saveProductImages(Request $request)
    {

        $file = $request->file('dzfile');
        $filename = uploadImage('products', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);


    }


    public function saveProductImagesDB(ProductImagesRequest $request)
    {

        try {
            // save dropzone images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    Image::create([
                        'product_id' => $request->product_id,
                        'photo' => $image,
                    ]);
                }
            }

            return redirect()->route('admin.products')->with(['success' => 'تم ألتحديث بنجاح']);

        } catch (\Exception $e) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }

    }



    public function deleteProductImages(Request $request){
        $fileName  = $request->input('fileName');
        if(isset($fileName) && !empty($fileName)){
            if(Storage::disk('products')->exists($fileName))
                Storage::disk('products')->delete($fileName);
        }
    }



}
