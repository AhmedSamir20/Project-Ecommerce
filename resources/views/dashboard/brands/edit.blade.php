@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/brand.main')}} </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.brands')}}"> {{__('admin/brand.brand')}} </a>
                                </li>
                                <li class="breadcrumb-item active"> {{__('admin/brand.edit')}} - {{$brand -> name}}
                                </li>
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
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.brands.update',$brand -> id)}}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input name="id" value="{{$brand -> id}}" type="hidden">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img src="{{$brand  -> photo}}" class=" rounded height-200" alt="{{__('admin/brand.logo')}}  ">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label> <strong>{{__('admin/brand.logo')}}</strong> </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i>
                                                    <strong> {{__('admin/brand.editBrand')}} </strong>
                                                </h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"><strong> {{__('admin/brand.name')}}</strong></label>
                                                            <input type="text" id="name" class="form-control" value="{{$brand -> name}}" name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1" name="is_active" id="switcheryColor4" class="switchery" data-color="success"
                                                                   @if($brand -> is_active == 1)checked @endif />
                                                            <label for="switcheryColor4" class="card-title ml-1"><strong>{{__('admin/brand.status')}}</strong> </label>

                                                            @error("is_active")
                                                                 <span class="text-danger">{{$message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <a type="button" class="btn btn-warning mr-1" type="button" href="{{route('admin.brands')}}">
                                                    <i class="ft-x"></i> {{__('admin/brand.retreat')}}
                                                </a>
                                                <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i>
                                                     {{__('admin/brand.update')}}
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
