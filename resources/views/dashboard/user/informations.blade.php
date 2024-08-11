@extends('dashboard.user._layout')

@section('title', $title)

@section('main')
    <link href="{{ asset('assets/css/dropzone.css') }}" rel="stylesheet">
    <style>
        form#upload-file span {
            color: darkgray;
        }

        .dz-default.dz-message {
            display: flex;
            justify-content: center;
        }
        img {
            height: auto;
            object-fit: contain;
        }
        #image_product_box div {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        #image_product_box span {
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    مدارک کاربر</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">خانه</a>
                    </li>
                    <!--end::item-->
                    <!--begin::item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::item-->
                    <!--begin::item-->
                    <li class="breadcrumb-item text-muted">مدارک کاربر</li>
                    <!--end::item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid container">
        <!--begin::Content container-->
        <div class="card animate__animated " id="verification_landing_card">
            <!--begin::کارت body-->
            <div class="card-body p-0">
                <!--begin::Wrapper-->
                <div class="card-px text-center py-5 my-5">
                    <!--begin::Title-->
                    <h2 class="fs-2x fw-bold mb-10">مدارک کاربر</h2>
                    <!--end::Title-->
                    <!--begin::توضیحات-->
                    <p class="text-gray-600 fs-4 fw-semibold mb-10">
                        مدارک خود (در زیر لیست شده است) را آماده و با کلیک بر روی دکمه شروع، آن‌ها را
                        ارسال کنید.
                    {{--<span class="d-block" style="color: darkred">نام گذاری فایل ها به انگلیسی و مشخص باشد:</span>(برای کارت ملی،
                    نام فایل melli باشد)--}}
                    <ul class="d-flex flex-column align-items-start">
                        <li>کارت ملی (پشت و رو)</li>
                        <li>شناسنامه (تمام صفحات)</li>
                        <li>مدارک تحصیلی</li>
                        <li>گواهینامه‌های آموزشی</li>
                    </ul>
                    </p>
                    <!--end::توضیحات-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::کارت body-->
        </div>
        <div class="container py-2">
            <form action="{{ asset('user/documents') }}" method="get">
                <label><b>نوع مدرک</b></label>
                <select name="type" class="form-control mb-2" onchange="this.form.submit()">
                    <option hidden="">نوع مدرک را انتخاب کنید</option>
                    <option value="all">نمایش مدارک ارسالی</option>
                    @foreach($types as $k=>$t)
                        <option value="{{ $k }}"{{($_GET['type']??'')==$k?' selected':''}}>{{ $t }}</option>
                    @endforeach
                </select>
            </form>
            @if(isset($_GET['type']) && $_GET['type']!='' && key_exists($type, $types))
                <div class="text-danger">لطفا مدرک‌های مرتبط با نوع سند انتخاب شده(در بالا) را ارسال کنید و سپس نوع مدرک
                    را تغییر دهید.
                </div>
                <form method="post" id="upload-file" action="{{ asset('user/documents') }}" class="dropzone">
                    <div>
                        {{ csrf_field() }}
                        <input name="file" type="file" multiple style="display:none"/>
                    </div>
                </form>
            @endif
        </div>
        <div class="text-center">
            @if(sizeof($image)>0)
            <span class="text-primary">برای حذف می‌توانید بر روی تصویری زیر کلیک کنید</span>
                <div id="show_product_image" class="my-5 py-5">
                    <img src="{{ asset('storage/'.$image[0]->url) }}" width="500px"
                         onclick="del_img('{{ $image[0]->id }}','{{ asset('user/docs/del_doc_img') }}','<?= Session::token() ?>')">
                </div>
            @else
                <div style="font-size: 20px">
                    فایلی ارسال نشده است.
                </div>
            @endif
            <div id="image_product_box" class="d-flex gap-6 mt-5">
                @foreach($image as $key=>$value)
                    <div>
                        <img src="{{ asset('storage/'.$value->url) }}" width="200px"
                             onclick="show_img('{{ asset('storage/'.$value->url) }}','{{ $value->id }}','<?= Session::token() ?>')">
                        <span>{{ $types[$value->type] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        <!--end::Content container-->
    </div>

    <script>
        $(document).on("input", ".numeric", function () {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/dropzone.js') }}"></script>
    <script>
        Dropzone.options.uploadFile = {
            dictDefaultMessage: '<img width="40px" src="{{ asset('assets/media/upload.png') }}"/>' + 'مدرک خود را اینجا رها کنید یا کلیک کنید.',
            acceptedFiles: ".png,.jpg,.gif,.jpeg",
            addRemoveLinks: true,
            init: function () {
                this.options.dictRemoveFile = 'حذف';
                this.options.dictInvalidFileType = 'امکان آپلود این فایل وجود ندارد';
                this.on("sending", function(file, xhr, formData) {
                    formData.append('type', '{{ $_GET['type']??'' }}');
                });
                this.on('success', function (file, response) {
                    if (response == 1) {
                        file.previewElement.classList.add('dz-success');
                    } else if (response == 'no') {
                        Swal.fire({
                            type: 'warning',
                            icon: "warning",
                            text: 'خطا در ثبت اطلاعات!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        console.log(response);
                        file.previewElement.classList.add('dz-error');
                        $(file.previewElement).find('.dz-error-message').text('خطا در آپلود فایل');
                    }
                });

                this.on('error', function (file, response) {
                    alert(JSON.stringify(response));
                });
            },
        };
        show_img = function (url, id, token) {
            let url2 = "'" + '<?= asset('user/docs/del_doc_img') ?>' + "'";
            let token2 = "'" + token + "'";
            let img = '<img width="500px" src=' + url + ' onclick="del_img(' + id + ',' + url2 + ',' + token2 + ')" />';
            //let img = '<img width="500px" src=' + url + ' />';
            $("#show_product_image").html(img);
        }
        function del_img(id, url, token) {
            let route = url + "/";
            if (!confirm("آیا از حذف مدرک مورد نظر مطمئن هستید؟!"))
                return false;

            let form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", route + id);
            let hiddenField2 = document.createElement("input");
            hiddenField2.setAttribute("name", "_token");
            hiddenField2.setAttribute("value", token);
            form.appendChild(hiddenField2);
            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }
    </script>
@endsection
