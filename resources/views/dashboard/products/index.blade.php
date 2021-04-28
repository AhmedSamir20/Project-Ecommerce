@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h2 class=""> {{__('admin/product.allproducts')}} </h2>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/product.products')}}</a>
                                </li>
                                <li class="breadcrumb-item active"> {{__('admin/product.allproducts')}}
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
                                    <h3 class=""><strong>{{__('admin/product.allproducts')}}</strong></h3>
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
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display  nowrap table-striped table-bordered ">
                                            <thead class=" text-center ">
                                            <tr >
                                                <th width="">{{__('admin/product.productname')}}</th>
                                                <th width="">{{__('admin/product.linkname')}}</th>
                                                <th width="">{{__('admin/product.status')}}</th>
                                                <th width="">{{__('admin/product.price')}}</th>
                                                <th width="">{{__('admin/product.Processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($products)
                                                @foreach($products as $product)
                                                    <tr>
                                                        <td >{{$product -> name}}</td>
                                                        <td>{{$product -> slug}}</td>
                                                        <td>{{$product -> getActive()}}</td>
                                                        <td>{{$product -> price}}</td>
                                                        <td class="">
                                                            <a href="{{route('edit.product.general',$product -> id)}}" data-toggle="tooltip"  data-original-title="{{__('admin/product.edit-product')}}" class="btn btn-outline-primary box-shadow-3 mb-1 editBrand">{{__('admin/product.edit-product')}}</a>&nbsp;&nbsp;
                                                            <a href="{{route('edit.product.price',$product -> id)}}" data-toggle="tooltip"  data-original-title="{{__('admin/product.edit-price')}}" class="btn btn-outline-success box-shadow-3 mb-1 editBrand">{{__('admin/product.price')}}</a>&nbsp;&nbsp;
                                                            <a href="{{route('edit.product.store',$product -> id)}}" data-toggle="tooltip"  data-original-title="{{__('admin/product.Edit-Store')}}" class="btn btn-outline-blue box-shadow-3 mb-1 editBrand">{{__('admin/product.stock')}}</a>&nbsp;&nbsp;
                                                            <a href="{{route('delete.product',$product->id)}}" data-toggle="tooltip"  data-original-title="{{__('admin/product.delete')}}" class="btn btn-outline-danger box-shadow-3 mb-1 deleteProduct">{{__('admin/product.delete')}}</a>&nbsp;&nbsp;
                                                            <a href="{{route('add.product.images',$product->id)}}" data-toggle="tooltip"  data-original-title="{{__('admin/product.Edit-photo')}}" class="btn btn-outline-warning box-shadow-3 mb-1 addProductImages">{{__('admin/product.productphoto')}}</a>
                                                            <a href="{{route('admin.options.create')}}" data-toggle="tooltip"  data-original-title="Delete" class="btn btn-outline-secondary box-shadow-3 mb-1 addProductImages">تفعيل</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">
                                            {!! $products -> links() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

@stop
