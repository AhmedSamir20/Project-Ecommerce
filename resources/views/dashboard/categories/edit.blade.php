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
                                    <a href="{{route('admin.dashboard')}}">
                                        {{__('admin/category.main')}}
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.mainCategories')}}">
                                        {{__('admin/category.main_category')}}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin/category.editCategory')}}{{$categories->name}}</li>
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
                                    <h4 class="card-title text-center">
                                        <strong> {{__('admin/category.editCategory')}}{{$categories->name}} </strong></h4>
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
                                @if($categories -> parent_id == null)
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <form class="form" method="post" id="categoryForm" enctype="multipart/form-data"
                                                  action="{{route('admin.mainCategories.update',$categories -> id)}}" >
                                                @csrf
                                                <h4 class="form-section"><i class="ft-home"></i>
                                                  <strong> {{__('admin/category.edit')}} {{__('admin/category.data_mainCategory')}}</strong>
                                                </h4>
                                                <input type="hidden" name="id" value="{{$categories->id}}">
                                                {{--======== photo =======--}}
                                                <div class="form-group">
                                                    <div class="text-center">
                                                        <img src="" class="rounded-circle  height-150" alt="{{__('admin/category.photo')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label><strong> {{__('admin/category.photo')}}</strong></label>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="file" name="photo">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                    @error('photo')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                {{--======== end photo =======--}}

                                                <!--======== if type of value equal one edit mainCategory =======-->
                                                <input type="hidden" name="type" id="type" value="1">

                                                <div class="form-body">
                                                    <div class="row">
                                                        {{--===============name===============--}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"><strong>{{__('admin/category.name')}}</strong></label>
                                                                <input type="text" id="name" class="form-control"
                                                                       placeholder=""
                                                                       name="name" value="{{$categories->name}}">
                                                                @error('name')
                                                                <span id="name_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        {{--===============slug===============--}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> <strong>{{__('admin/category.slug')}}</strong> </label>
                                                                <input type="text" id="slug" class="form-control" name="slug" value="{{$categories->slug}}">
                                                                @error('slug')
                                                                <span id="slug_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        {{--===============slug===============--}}
                                                        <div class="col-md-6">
                                                            <div class="form-group mt-1">
                                                                <label for="switcheryColor4" class="card-title ml-1">
                                                                    <strong> {{__('admin/category.status')}}</strong>
                                                                </label>
                                                                <input type="checkbox" name="is_active" value="1"
                                                                       id="switcheryColor4"
                                                                       class="switchery active" data-color="success"
                                                                       @if($categories->is_active == 1 ) checked @endif/>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="form-actions">
                                                    <a href="{{route('admin.mainCategories')}}" type="button"
                                                       class="btn btn-warning mr-1" data-dismiss="modal">
                                                        <i  class="ft-x"></i> {{__('admin/category.retreat')}}
                                                    </a>
                                                    <button class="btn btn-primary" id="updateCategory">
                                                             {{__('admin/category.update')}}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <form class="form" method="post" id="categoryForm" enctype="multipart/form-data"
                                                  action="{{route('admin.mainCategories.update',$categories -> id)}}" >
                                                @csrf
                                                <h4 class="form-section"><i class="ft-home"></i>
                                                        {{__('admin/category.edit')}} {{__('admin/category.data_subCategory')}}
                                                </h4>
                                                <input type="hidden" name="id" value="{{$categories->id}}">
                                               {{----}}
                                                <div class="form-group">
                                                    <div class="text-center">
                                                        <img src="" class="rounded-circle  height-150" alt="{{__('admin/category.photo')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label> <strong>{{__('admin/category.photo')}}</strong> </label>
                                                    <label id="projectinput7" class="file center-block">
                                                        <input type="file" id="file" name="photo">
                                                        <span class="file-custom"></span>
                                                    </label>
                                                    @error('photo')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                              {{----}}

                                                <!--======== if type of value equal two edit subCategory =======-->
                                                <input type="hidden" name="type" id="type" value="2">

                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"><strong>{{__('admin/category.name')}} </strong></label>
                                                                <input type="text" id="name" class="form-control" name="name" value="{{$categories->name}}">
                                                                @error('name')
                                                                <span id="name_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"><strong> {{__('admin/category.slug')}} </strong></label>
                                                                <input type="text" id="slug" class="form-control" name="slug" value="{{$categories->slug}}">
                                                                @error('slug')
                                                                <span id="slug_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                    {{--================select list subCategory=============--}}
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="projectinput2"><strong> {{__('admin/category.choose category')}} </strong></label>
                                                                <select name="parent_id" id="parent_id"  class="select2 form-control " style="width: 100%">
                                                                    <optgroup label="{{__('admin/category.choose_main_category')}} ">
                                                                        @if($mainCategories && $mainCategories -> count() > 0)
                                                                            {{--As you can see, we load the main categories, and then load children categories --}}
                                                                            @foreach($mainCategories as $mainCategory)
                                                                                <option value="{{$mainCategory->id}}"
                                                                                   @if($mainCategory -> id == $categories->parent_id) selected @endif>
                                                                                   {{$mainCategory->name}}</option>
                                                                                {{-- using associative array   $key => $value  --}}
                                                                                @foreach ($mainCategory->childrenCategories as $index => $childCategory)
                                                                                    @include('dashboard.categories.child_category_edit', ['child_category' => $childCategory])
                                                                                @endforeach
                                                                            @endforeach
                                                                        @endif
                                                                    </optgroup>
                                                                </select>
                                                                @error('parent_id')
                                                                <span id="parent_id_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    {{--============== End select list subCategory===============--}}
                                                    {{--============start status========--}}
                                                        <div class="col-md-4">
                                                            <div class="form-group"  style="margin-top: 2.3rem ; text-align: center">
                                                                <label for="switcheryColor4" class="card-title mr-2 ">
                                                                    <strong>{{__('admin/category.status')}} </strong>
                                                                </label>
                                                                <input type="checkbox"  name="is_active" value="1" id="switcheryColor4" data-color="success"
                                                                       class="switchery  active" @if($categories->is_active == 1 ) checked @endif/>
                                                            </div>
                                                        </div>
                                                    {{--============End status========--}}
                                                    </div>
                                                </div>


                                                <div class="form-actions">
                                                    <a href="{{route('admin.mainCategories')}}" type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                                                       <i class="ft-x"></i> {{__('admin/category.retreat')}}
                                                    </a>
                                                    <button class="btn btn-primary" id="updateCategory"> {{__('admin/category.update')}}</button>

                                                </div>

                                            </form>


                                        </div>
                                    </div>

                                @endif
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@endsection


