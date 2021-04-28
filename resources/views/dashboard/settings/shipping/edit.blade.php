@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/shipping.main')}}</a></li>
                                <li class="breadcrumb-item">{{__('admin/shipping.setting')}}</li>
                                <li class="breadcrumb-item">{{__('admin/shipping.shipping-method')}}</li>
                                <li class="breadcrumb-item active"> {{__('admin/shipping.edit')}} - {{$shippingMethod->value}}</li>
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
                                    <h3 class="text-center">
                                        <strong>
                                            {{__('admin/shipping.edit')}}- {{$shippingMethod->value}}
                                        </strong>
                                    </h3>
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
                                        <form class="form" action="{{route('update.shipping.methods',$shippingMethod -> id)}}"
                                              method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <h4 class="form-section"> <i class="ft-home"></i>
                                                {{__('admin/shipping.shipping-method')}} - {{$shippingMethod->value}}
                                            </h4>
                                            <input type="hidden" name="id" value="{{$shippingMethod -> id  }}">

                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> {{__('admin/shipping.shipping-method')}} </label>
                                                            <input type="text" value="{{$shippingMethod -> value  }}" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="value">
                                                            @error("value")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> {{__('admin/shipping.shipping price')}} </label>
                                                            <input type="number" value="{{$shippingMethod -> plan_value}}" id="plan_value"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="plan_value">
                                                            @error("plan_value")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                    <i class="ft-x"></i> {{__('admin/shipping.retreat')}}
                                                </button>

                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i>{{__('admin/shipping.update')}}
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
