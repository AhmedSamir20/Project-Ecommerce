<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderImagesRequest;
use App\Models\Banner;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function addImages()
    {

         $images = Banner::get();
        return view('dashboard.Banner.images.create', compact('images'));
    }
    //to save images to folder only
    public function saveBannerImages(Request $request)
    {


        $file = $request->file('dzfile');
        $filename = uploadImage('banners', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }
    public function saveBannerImagesDB(SliderImagesRequest $request)
    {

        try {
            // save dropzone images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    Banner::create([
                        'photo' => $image,
                    ]);
                }
            }

            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

        }
    }

    public function removeImagesOfBannerFromFolder(Request $request){
        $fileName  = $request->input('fileName');
        if(isset($fileName) && !empty($fileName)){
            if(Storage::disk('banners')->exists($fileName))
                Storage::disk('banners')->delete($fileName);
        }

    }

    public function deleteImagesOfBanner($id){
        try {
            $image=Banner::find($id);
            if (!$image)
                return redirect()->route('admin.sliders.create')-> with('error',__('admin/product.error'));

            DB::beginTransaction();
            $path = public_path('assets/images/banners/').''.basename($image->photo);
            unlink($path);
            $image->delete();
            DB::commit();
            return redirect()->route('admin.banner.create')-> with('success','Image was deleted successfuly');
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.banner.create')->with('error',__('admin/product.exception-error'));
        }


    }


}
