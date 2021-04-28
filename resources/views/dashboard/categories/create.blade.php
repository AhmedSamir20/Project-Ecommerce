@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.dashboard')}}"> {{__('admin/category.main')}} </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.mainCategories')}}"> {{__('admin/category.categories')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin/category.add-categories')}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">

                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.mainCategories.store')}}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf

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

                                              <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> <strong> {{__('admin/category.add-categories')}} </strong></h4>
                                                <div class="row">
                                                    {{--========== input name==========--}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> <strong>{{__('admin/category.name')}}</strong></label>
                                                            <input type="text" class="form-control"  value="{{old('name')}}" name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{--========== input slug==========--}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"><strong>{{__('admin/category.slug')}}</strong></label>
                                                            <input type="text"   name="slug"  class="form-control" value="{{old('slug')}}"/>
                                                            @error("slug")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--========== inpute select list===========--}}
                                                <div class="row hidden" id="cats_list">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"><strong>{{__('admin/category.choose_main_category')}}</strong></label>
                                                            <select name="parent_id" style="width:50%;"
                                                                    class=" form-control">
                                                                <option value="" disabled selected>{{__('admin/category.Select-your-product')}}</option>
                                                                    @if ($categories && $categories->count() > 0)
                                                                        @php
                                                                            if (App::getLocale() == "ar")
                                                                                subCatRecursion($categories, 0,'←');
                                                                            else
                                                                                subCatRecursion($categories, 0,'→');
                                                                        @endphp
                                                                    @endif
                                                            </select>
                                                            @error('parent_id')
                                                            <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                               {{--========== status===========--}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1" name="is_active" id="switcheryColor4" class="switchery" data-color="success" checked/>
                                                            <label for="switcheryColor4" class="card-title ml-1"><strong>{{__('admin/category.status')}} </strong></label>
                                                            @error("is_active")
                                                            <span class="text-danger">{{$message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{--========== checkBox===========--}}
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="radio" name="type" value="1" checked class="switchery"  data-color="success" />
                                                            <label class="card-title "> <strong>{{__('admin/category.add_mainCategory')}} </strong></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="radio"  name="type"  value="2" class="switchery" data-color="success" />
                                                            <label  class="card-title "><strong> {{__('admin/category.add_subCategory')}} </strong> </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                    <i class="ft-x"></i>{{__('admin/category.retreat')}}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i>{{__('admin/category.add-categories')}}
                                                </button>
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

@stop
@section('script')

    <script>
        $('input:radio[name="type"]').change(
            function () {
                if (this.checked && this.value == '2') {  // 1 if main cat - 2 if sub cat
                    $('#cats_list').removeClass('hidden');
                } else {
                    $('#cats_list').addClass('hidden');
                }
            });
    </script>
@stop
