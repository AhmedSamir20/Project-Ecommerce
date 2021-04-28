@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"></h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.dashboard')}}">{{__('admin/product.main')}}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('index.product')}}"> {{__('admin/product.product')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin/product.addnewProduct')}}</li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class=" text-center"> <strong>{{__('admin/product.addnewProduct')}} </strong></h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--  Begin Form Edit -->
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" method="post" action="{{route('save.product.general')}}"
                                              id="categoryForm" enctype="multipart/form-data">
                                            @csrf
                                        <ul class="nav nav-tabs nav-linetriangle no-hover-bg">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="generalLable-tab" data-toggle="tab"
                                                   href="#general" aria-controls="general"  aria-expanded="true">
                                                    <strong>{{__('admin/product.General-product-information')}}</strong></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="priceLable-tab" data-toggle="tab"
                                                   href="#price" aria-controls="price"  aria-expanded="false">
                                                    <strong>{{__('admin/product.information-product-stock')}}</strong></a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="storeLable-tab" data-toggle="tab" href="#store" aria-controls="store"
                                                   aria-expanded="false"><strong>{{__('admin/product.information-product-stock')}}</strong></a>
                                            </li>
                                        </ul>


                                        <div class="tab-content px-1 pt-1">
                                            <div role="tabpanel" class="tab-pane active" id="general"
                                                 aria-labelledby="generalLable-tab"
                                                 aria-expanded="true">
                                                    <h4 class="form-section"><i class="ft-home"></i>
                                                        <strong> {{__('admin/product.addnewProduct')}}</strong>
                                                    </h4>
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label  for="projectinput1"><strong>{{__('admin/product.name')}}</strong></label>
                                                                    <input type="text" id="name" class="form-control"name="name" value="{{old('name')}}">
                                                                    @error('name')
                                                                    <span id="name_error"
                                                                          class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label  for="projectinput1"><strong>{{__('admin/product.linkname')}}</strong> </label>
                                                                    <input type="text" id="slug" class="form-control"  name="slug" value="{{old('slug')}}">
                                                                    @error('slug')
                                                                    <span id="slug_error"
                                                                          class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"><strong>{{__('admin/product.shortdesc')}}</strong></label>
                                                                    <textarea name="short_description"
                                                                              id="short-description" cols="3" rows="4"
                                                                              class="form-control"></textarea>
                                                                </div>
                                                                @error('short_description')
                                                                <span id="slug_error"
                                                                      class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group mt-4">
                                                                    <label for="switcheryColor4"  class="card-title mr-1">
                                                                        <strong>{{__('admin/product.status')}}</strong>
                                                                    </label>
                                                                    <input type="checkbox" name="is_active" value="1"  id="switcheryColor4"
                                                                   class="switchery active" data-color="success"  checked/>
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="projectinput2"><strong> {{__('admin/product.choosecategory')}}</strong> </label>
                                                                    <select name="categories[]" id="parent_id"  class="select2 form-control "  style="width: 100%"  multiple>
                                                                        <optgroup
                                                                            label="{{__('admin/product.plzmaincategoriesselect')}} ">
                                                                            @if($data['categories'] && $data['categories'] -> count() > 0)
                                                                                @foreach($data['categories'] as $mainCategory)
                                                                                    <option
                                                                                        value="{{$mainCategory->id}}">{{$mainCategory->name}}</option>

                                                                                    @foreach ($mainCategory->childrenCategories as $index => $childCategory)
                                                                                        @include('dashboard.categories.child_category', ['child_category' => $childCategory])
                                                                                    @endforeach
                                                                                @endforeach
                                                                            @endif

                                                                        </optgroup>
                                                                    </select>
                                                                    @foreach($data['categories'] as $index)
                                                                        @if($errors->has('categories.'.$index))
                                                                            <span id="parent_id_error"
                                                                                  class="text-danger">{{$errors->any('categories.'.$index)}}</span>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="projectinput2"><strong>{{__('admin/product.tagsselect')}}</strong></label>
                                                                    <select name="tags[]" id="parent_id"   class="select2 form-control " style="width: 100%"   multiple>
                                                                        <optgroup label="{{__('admin/product.plztagsselect')}}">
                                                                            @if($data['tags'] && $data['tags'] -> count() > 0)
                                                                                @foreach($data['tags'] as $tag)
                                                                                    <option  value="{{$tag->id}}">{{$tag->name}}</option>
                                                                                @endforeach
                                                                            @endif

                                                                        </optgroup>
                                                                    </select>
                                                                    @error('tags')
                                                                         <span id="parent_id_error"  class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="projectinput2"><strong>{{__('admin/product.brandsselect')}}</strong></label>
                                                                    <select name="brand_id" id="brand" class="select2 form-control " style="width:100% ">
                                                                        <optgroup label="{{__('admin/product.brandEdittagsselect')}}">
                                                                            @if($data['brand'] && $data['brand'] -> count() > 0)
                                                                                @foreach($data['brand'] as $brand)
                                                                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </optgroup>
                                                                    </select>
                                                                    @error('brand_id')
                                                                    <span id="parent_id_error"
                                                                          class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <h4 class="form-section"><i class="ft-edit"></i>
                                                                        <strong>{{__('admin/product.productdesc')}}</strong>
                                                                    </h4>
                                                                    <textarea name="description" id="summernote" cols="15"   rows="15" ></textarea>
                                                                </div>
                                                                @error('description')
                                                                <span id="slug_error"
                                                                      class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="tab-pane" id="price"
                                                 aria-labelledby="priceLable-tab">

                                                    <h4 class="form-section"><i class="ft-home"></i>
                                                        <strong>{{__('admin/product.add-price-product')}}</strong>
                                                    </h4>
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="projectinput1" class="ml-1"><strong>{{__('admin/product.productprice')}}</strong></label>
                                                                    <input type="number" id="price" class="form-control" name="price" value="{{old('price')}}">
                                                                    @error('price')
                                                                    <span id="price_error"
                                                                          class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label  for="projectinput1" class="ml-1"><strong> {{__('admin/product.specialprice')}}</strong></label>
                                                                    <input type="number" id="special_price" class="form-control"
                                                                           placeholder=""
                                                                           name="special_price" value="{{old('special_price')}}">
                                                                    @error('special_price')
                                                                    <span id="special_price_error"
                                                                          class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="projectinput2" class="ml-1"><strong>{{__('admin/product.pricetype')}}</strong></label>
                                                                    <select name="special_price_type" id="special_price_type"
                                                                            class="select2 form-control width-300">
                                                                        <optgroup label="">
                                                                            <option value="">{{__('admin/product.productPriceChose')}}</option>
                                                                            <option value="percent">percent</option>
                                                                            <option value="fixed"> fixed</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>
                                                                @error('special_price_type')
                                                                    <span id="special_price_type_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="srartdate" class="card-title ml-1"><strong>{{__('admin/product.begindate')}}</strong></label>
                                                                    <input type="date" name="special_price_start" id="special_price_start" class="form-control" value="{{old('special_price_start')}}">
                                                                </div>
                                                                @error('special_price_start')
                                                                <span id="special_price_start_error"
                                                                      class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="enddate" class="card-title ml-1"><strong>{{__('admin/product.enddate')}}</strong></label>
                                                                    <input type="date" name="special_price_end" id="special_price_end" class="form-control" value="{{old('special_price_end')}}">
                                                                </div>
                                                                @error('special_price_end')
                                                                <span id="special_price_end_error"
                                                                      class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>


                                            </div>

                                            <div class="tab-pane" id="store"
                                                 aria-labelledby="storeLable-tab">
                                                    <h4 class="form-section"><i class="ft-home"></i>
                                                        <strong>{{__('admin/product.inventory-Management ')}}</strong>
                                                    </h4>
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1" class="ml-1"><strong>{{__('admin/product.sku')}}</strong></label>
                                                                <input type="text" id="SKU" class="form-control" name="SKU" value="{{old('SKU')}}">
                                                                @error('SKU')
                                                                <span id="SKU_error"
                                                                      class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"><strong>{{__('admin/product.trackstock')}}</strong></label>
                                                                <select name="manage_stock" id="manage_stock" class="form-control">
                                                                    <optgroup label="{{__('admin/product.DoYoutrackstock')}}">
                                                                        <option value="">{{__('admin/product.DoYoutrackstock')}}</option>
                                                                        <option value="1">{{__('admin/product.enabletrack')}}</option>
                                                                        <option selected value="0">{{__('admin/product.disabletrack')}}</option>
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                            @error('manage_stock')
                                                            <span id="manage_stock_error"
                                                                  class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"><strong>{{__('admin/product.productstatus')}}</strong></label>
                                                                <select name="in_stock" id="in_stock" class="form-control">
                                                                    <optgroup label="{{__('admin/product.productStatusChose')}}">
                                                                        <option value="">{{__('admin/product.productStatusChose')}}</option>
                                                                        <option value="1">{{__('admin/product.available')}}</option>
                                                                        <option value="0">{{__('admin/product.unavailable')}}</option>
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                            @error('in_stock')
                                                            <span id="in_stockerror"
                                                                  class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-6" style="display:none"  id="qtyDiv">
                                                            <div class="form-group">
                                                                <label for="projectinput1"><strong>{{__('admin/product.quantity')}}</strong></label>
                                                                <input type="number" id="qty" class="form-control" value="{{old('qty')}}" name="qty">
                                                                @error("qty")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                            <div class="form-actions">
                                                <a href="{{route('admin.mainCategories')}}" type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                                                  <i class="ft-x"></i> {{__('admin/category.retreat')}}
                                                </a>
                                                <button type="submit" class="btn btn-primary" id="updateCategory"> {{__('admin/product.save')}}</button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on('change','#manage_stock',function(){
            if($(this).val() == 1 ){
                $('#qtyDiv').show();
            }else{
                $('#qtyDiv').hide();
            }
        });

        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,

            });

        });

    </script>
@stop




