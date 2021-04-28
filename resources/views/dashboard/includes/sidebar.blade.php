<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item menu-content">
                <a href=""><i class="la la-mouse-pointer"></i>
                    <span class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.dashboard')}}
                    </span>
                </a>
            </li>

            <li class="nav-item   ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">
                        {{__('admin/sidebar.languages')}} </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class="{{app()->getLocale().'/admin/lang' == request()->path() ? 'active' : ''}}">
                        <a class="menu-item" href="" data-i18n="nav.dash.ecommerce">
                            {{__('admin/sidebar.View-all')}}
                        </a>
                    </li>
                    <li class="{{app()->getLocale().'/admin/lang/create' == request()->path() ? 'active' : ''}}">
                        <a class="menu-item" href="" data-i18n="nav.dash.crypto">
                            {{__('admin/sidebar.Add-a-new-language')}}
                        </a>
                    </li>
                </ul>
            </li>

            {{--===================================== category=======================================--}}
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">
                        {{__('admin/sidebar.Departments-main')}} </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\Category::count()}}
                    </span>
                </a>

                <ul class="menu-content">
                    <li class="{{ (request()->segment(3) == 'categories') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('admin.mainCategories')}}" data-i18n="nav.dash.ecommerce">
                            {{__('admin/sidebar.View-all')}}
                        </a>
                    </li>
                    <li >
                        <a class="menu-item" href="{{route('admin.mainCategories.create')}}"data-i18n="nav.dash.crypto">
                            {{__('admin/sidebar.Add-a-new-section')}}
                        </a>
                    </li>
                </ul>
            </li>

            {{--===================================== brands=======================================--}}
            <li class="nav-item">
                <a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">
                        {{__('admin/sidebar.Commercial-brands')}}
                    </span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2">
                        {{App\Models\Brand::count()}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(3) == 'brands') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('admin.brands')}}" data-i18n="nav.dash.ecommerce">
                            {{__('admin/sidebar.View-all')}}
                        </a>
                    </li>
                    <li >
                        <a class="menu-item" href="{{route('admin.brands.create')}}" data-i18n="nav.dash.crypto">
                            {{__('admin/sidebar.Add-a-new-brand')}}
                        </a>
                    </li>
                </ul>
            </li>
            {{--===================================== tags=======================================--}}
            <li class="nav-item">
                <a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">
                        {{__('admin/sidebar.tags')}}
                    </span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2">
                        {{App\Models\Tag::count()}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li  class="{{ (request()->segment(3) == 'tags') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('admin.tags')}}" data-i18n="nav.dash.ecommerce">
                            {{__('admin/sidebar.View-all')}}
                        </a>
                    </li>
                    <li >
                        <a class="menu-item" href="{{route('admin.tags.create')}}" data-i18n="nav.dash.crypto">
                            {{__('admin/sidebar.add-new-tag')}}
                        </a>
                    </li>
                </ul>
            </li>

            {{--===================products===================--}}
            <li class="nav-item">
                <a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">
                        {{__('admin/sidebar.products')}} </span>
                    <span class="badge badge badge-success badge-pill float-right mr-2">
                        {{App\Models\Product::count()}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li  class="{{ (request()->segment(3) == 'product') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('index.product')}}" data-i18n="nav.dash.ecommerce">
                            {{__('admin/sidebar.View-all')}}
                        </a>
                    </li>
                    <li >
                        <a class="menu-item" href="{{route('create.product')}}" data-i18n="nav.dash.crypto">
                            {{__('admin/sidebar.add-new-product')}}
                        </a>
                    </li>
                </ul>
            </li>

            {{--===================attributes===================--}}
            <li class="nav-item">
                <a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">
                        {{__('admin/sidebar.Attribute')}}
                    </span>
                    <span class="badge badge badge-success badge-pill float-right mr-2">
                        {{App\Models\Attribute::count()}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{request()->segment(3)=='attributes'? 'active' : ''}}">
                        <a class="menu-item" href="{{route('admin.attributes')}}" data-i18n="nav.dash.ecommerce">
                            {{__('admin/sidebar.View-all')}}
                        </a>
                    </li>
                    <li >
                        <a class="menu-item" href="{{route('admin.attributes.create')}}" data-i18n="nav.dash.crypto">
                            {{__('admin/sidebar.add-new-Attribute')}}
                        </a>
                    </li>
                </ul>
            </li>
            {{--===================Option===================--}}
            <li class="nav-item">
                <a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">
                        {{__('admin/sidebar.Properties-values')}} </span>
                    <span class="badge badge badge-success badge-pill float-right mr-2">
                        {{App\Models\Option::count()}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->segment(3)=='options' ? 'active' : ''}}">
                        <a class="menu-item" href="{{route('admin.options')}}" data-i18n="nav.dash.ecommerce">
                            {{__('admin/sidebar.View-all')}}
                        </a>
                    <li >
                    <li>
                        <a class="menu-item" href="{{route('admin.options.create')}}" data-i18n="nav.dash.crypto">
                            {{__('admin/sidebar.add-new-value')}}
                        </a>
                    </li>
                </ul>
            </li>
            {{--===================---===================--}}
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الطلاب  </span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href=""
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="" data-i18n="nav.dash.crypto">أضافة
                            طالب </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">تذاكر المراسلات   </span>
                    <span
                        class="badge badge badge-danger  badge-pill float-right mr-2">0</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href=""
                                          data-i18n="nav.dash.ecommerce"> تذاكر الطلاب </a>
                    </li>
                </ul>
            </li>
            {{--===============================shipping=======================--}}
            <li class=" nav-item">
                <a href="#"><i class="la la-television"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">
                        {{__('admin/sidebar.settings')}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="#" data-i18n="nav.templates.vert.main">
                            {{__('admin/sidebar.shipping_methods')}}
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a class="menu-item" href="{{route('edit.shipping.methods','free')}}" data-i18n="nav.templates.vert.classic_menu">
                                    {{__('admin/sidebar.free_delivery')}}
                                </a>
                            </li>
                            <li>
                                <a class="menu-item" href="{{route('edit.shipping.methods','inner')}}" data-i18n="nav.templates.vert.compact_menu">
                                    {{__('admin/sidebar.internal-delivery')}}
                                </a>
                            </li>
                            <li>
                                <a class="menu-item" href="{{route('edit.shipping.methods','outer')}}" data-i18n="nav.templates.vert.content_menu">
                                   {{__('admin/sidebar.external-delivery')}}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li><a class="menu-item" href="#" data-i18n="nav.templates.horz.main">{{__('admin/sidebar.slider-main')}}</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('admin.sliders.create')}}"
                                   data-i18n="nav.templates.horz.classic">{{__('admin/sidebar.slider-photo')}}</a>
                            </li>
                        </ul>
                    </li>

                    <li><a class="menu-item" href="#"
                           data-i18n="nav.templates.vert.main"> {{ __('admin/sidebar.banner') }} </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('admin.banner.create')}}"
                                   data-i18n="nav.templates.vert.classic_menu">{{ __('admin/sidebar.add_banner') }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
