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
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.dashboard')}}">{{__('translate-admin/category.main')}}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('index.product')}}"> المنتجات -</a>

                                </li>
                                <li class="breadcrumb-item active"> اضافة منتج جديد
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
                                    <h4 class="card-title text-center">
                                        <strong> اضافة منتج جديد
                                        </strong></h4>
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

                                {{----}}
                                <div class="row mt-2">
                                    @isset($product)
                                        @foreach($product->images as $product_images)
                                            <div class="col-md-4 ">
                                                <div class="text-center">
                                                    <img src="{{$product_images->photo}}" alt="photo" class="img-thumbnail height-150 width-300">
                                                    <form action="{{route('delete.image', $product_images->id)}}" method="post">
                                                        @csrf  @method('delete')
                                                        <button type="submit"  data-toggle="tooltip" data-original-title="Delete"
                                                        class="btn btn-danger box-shadow-3 mb-1 " style="width: 80px; margin-top: 1em"> حذف</button>
                                                    </form>
                                                </div>
                                            </div>

                                        @endforeach
                                    @endisset
                                </div>
                                {{----}}

                                <!--  Begin Form Edit -->
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" method="post" action="{{route('save.images.inDB')}}"
                                              id="addImagesForm" enctype="multipart/form-data">
                                            @csrf
                                            <div id="photo">
                                                <div class="form-body">
                                                    <h4 class="form-section"><i class="ft-home"></i> صور المنتج </h4>
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <div class="form-group">
                                                        <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                            <div class="dz-message">يمكنك رفع اكثر من صوره هنا</div>
                                                        </div>
                                                        <br><br>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-actions">
                                                <a href="{{route('index.product')}}" type="button"
                                                   class="btn btn-warning mr-1" data-dismiss="modal">
                                                    <i class="ft-x"></i> {{__('translate-admin/category.retreat')}}
                                                </a>
                                                <button type="submit" class="btn btn-primary" id="updateCategory"> حفظ
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

@endsection

@section('script')
    <script type="text/javascript">

        var uploadedDocumentMap = {}

        Dropzone.options.dpzMultipleFiles = {
            paramName: "dzfile", // The name that will be used to transfer the file
            //autoProcessQueue: false,
            maxFilesize: 5, // MB
            clickable: true,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
            dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
            dictCancelUpload: "الغاء الرفع ",
            dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
            dictRemoveFile: "حذف الصوره",
            dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هضا ",
            headers: {
                'X-CSRF-TOKEN':
                    "{{ csrf_token() }}"
            }
            ,
            url: "{{ route('save.images.inFolder') }}", // Set the url
            success:
                function (file, response) {
                    $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
                    uploadedDocumentMap[file.name] = response.name
                }
            ,

            removedfile: function (file) {
                file.previewElement.remove();
                var name = '';
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name;
                } else {
                    name = uploadedDocumentMap[file.name];
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove();
                // Add this code in removedfile dropzone
                $.ajax({
                    type: 'POST',
                    url: '{{ route('delete.image.fromFolder') }}',
                    data: {
                        fileName: name
                    },
                    dataType: 'html',
                    headers: {
                        'X-CSRF-TOKEN':
                            "{{ csrf_token() }}"
                    },
                    success: function(data){
                        var rep = JSON.parse(data);
                    }
                });
            },
            // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
            init: function () {
                    @if(isset($event) && $event->images)
                var files;
                {!! json_encode($event->images) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
                }
                @endif
            }
        }
    </script>
@endsection


