<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderImagesRequest;
use App\Models\Slider;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function addImages()
    {

         $images = Slider::get();
        return view('dashboard.sliders.images.create', compact('images'));
    }
    //to save images to folder only
    public function saveSliderImages(Request $request)
    {

        $file = $request->file('dzfile');
        $filename = uploadImage('sliders', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }
    public function saveSliderImagesDB(SliderImagesRequest $request)
    {

        try {
            // save dropzone images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    Slider::create([
                        'photo' => $image,
                    ]);
                }
            }

            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

        }
    }

    public function removeImagesOfSliderFromFolder(Request $request){
        $fileName  = $request->input('fileName');
        if(isset($fileName) && !empty($fileName)){
            if(Storage::disk('sliders')->exists($fileName))
                Storage::disk('sliders')->delete($fileName);
        }

    }

    public function deleteImagesOfSlider($id){
        try {
            $image=Slider::find($id);
            if (!$image)
                return redirect()->route('admin.sliders.create')-> with('error',__('admin/product.error'));

            DB::beginTransaction();
            $path = public_path('assets/images/sliders/').''.basename($image->photo);
            unlink($path);
            $image->delete();
            DB::commit();
            return redirect()->route('admin.sliders.create')-> with('success','Image was deleted successfuly');
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.sliders.create')->with('error',__('admin/product.exception-error'));
        }


    }


}
