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
                                    <a href="{{route('admin.dashboard')}}"><strong> {{__('admin/category.main')}}</strong></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('index.product')}}"><strong>{{__('admin/product.product')}}</strong></a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <strong>{{__('admin/product.edit-product')}} -  {{$product_general->name}}</strong>
                                </li>
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
                                    <h4 class=" text-center">
                                        <strong> {{__('admin/product.edit-product')}} - {{$product_general->name}} </strong>
                                    </h4>
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
                                            <form class="form" method="post"
                                                  action="{{route('update.product.general',$product_general->id)}}"
                                                  id="categoryForm" enctype="multipart/form-data">
                                                @csrf
                                                <h4 class="form-section"><i class="ft-home"></i>
                                                     <strong> {{__('admin/product.edit-general-product-data')}}</strong>
                                                </h4>
                                                <input type="hidden" name="product_id" value="{{$product_general->id}}">

                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"><strong> {{__('admin/product.name')}} </strong></label>
                                                                <input type="text" id="name" class="form-control" name="name" value="{{$product_general->name}}">
                                                                @error('name')
                                                                     <span id="name_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label  for="projectinput1"><strong> {{__('admin/product.linkname')}} </strong></label>
                                                                <input type="text" id="slug" class="form-control"
                                                                       name="slug" value="{{$product_general->slug}}">
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
                                                                <textarea name="short_description" id="short-description" cols="3" rows="4"
                                                                          class="form-control">{{$product_general->short_description}}</textarea>
                                                            </div>
                                                            @error('short_description')
                                                            <span id="slug_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6" >
                                                            <div class="form-group mt-4 "  >
                                                                <label for="switcheryColor4" class="card-title mr-1"><strong>{{__('admin/product.status')}}</strong></label>
                                                                <input type="checkbox" name="is_active" value="1"
                                                                       id="switcheryColor4" class="switchery active" data-color="success"
                                                                       @if($product_general->is_active == 1) checked @endif/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="projectinput2"><strong> {{__('admin/category.choose category')}}</strong> </label>
                                                                <select name="categories[]" id="parent_id" multiple
                                                                        class="select2 form-control" style="width: 100%">
                                                                    <optgroup label="{{__('admin/product.plzCategoriesSelectEdit')}} ">
                                                                        @if($data['categories'] && $data['categories'] -> count() > 0)
                                                                            @foreach($data['categories'] as $mainCategory)
                                                                                <option value="{{$mainCategory->id}}" @if($product_categories->contains('id', $mainCategory->id ) == $mainCategory->id) selected @endif>{{$mainCategory->name}}</option>
                                                                                @foreach ($mainCategory->childrenCategories as $index => $childCategory)
                                                                                    @include('dashboard.products.edit.child_category_edit', ['child_category' => $childCategory])
                                                                                @endforeach
                                                                            @endforeach
                                                                        @endif
                                                                    </optgroup>
                                                                </select>
                                                                @foreach($data['categories'] as $index)
                                                                    @if($errors->has('categories.'.$index))
                                                                        <span id="parent_id_error" class="text-danger">{{$errors->any('categories.'.$index)}}</span>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group"> <label for="projectinput2"><strong> {{__('admin/product.choosetags')}}</strong> </label>
                                                                <select name="tags[]" id="parent_id"
                                                                        class="select2 form-control" style="width: 100%"
                                                                        multiple>
                                                                    <optgroup label="{{__('admin/product.plztagsselectEdit')}}">

                                                                        @if($data['tags'] && $data['tags'] -> count() > 0)
                                                                            @foreach($data['tags'] as $tags)
                                                                                <option value="{{$tags->id}}"
                                                                                        @if($product_tags->contains('id', $tags->id ) == $tags->id) selected @endif>
                                                                                    {{$tags->name}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </optgroup>
                                                                </select>
                                                                @error('tags')
                                                                     <span id="parent_id_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="projectinput2"><strong>{{__('admin/product.choosebrand')}}</strong></label>
                                                                <select name="brand_id" id="brand"
                                                                        class="select2 form-control"  style="width: 100%">
                                                                    <optgroup label="{{__('admin/product.brandEdittagsselect')}}">
                                                                        @if($data['brand'] && $data['brand'] -> count() > 0)
                                                                            @foreach($data['brand'] as $brand)
                                                                                <option value="{{$brand->id}}" @if($product_general->brand_id == $brand->id) selected @endif>{{$brand->name}}</option>
                                                                            @endforeach
                                                                        @endif

                                                                    </optgroup>
                                                                </select>
                                                                @error('brand_id')
                                                                     <span id="parent_id_error" class="text-danger">{{$message}}</span>
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
                                                                <textarea name="description"  id="summernote" cols="15" rows="15" >{{$product_general->description}}</textarea>
                                                            </div>
                                                            @error('description')
                                                            <span id="slug_error"
                                                                  class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <a href="{{route('index.product')}}" type="button" class="btn btn-warning mr-1"
                                                       data-dismiss="modal"><i class="ft-x"></i> {{__('admin/category.retreat')}}
                                                    </a>
                                                    <button class="btn btn-primary" id="updateCategory"> {{__('admin/category.update')}}</button>
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
        $(document).ready(function() {


            $('#summernote').summernote({
                height: 300,

            });

        });
    </script>
@stop

