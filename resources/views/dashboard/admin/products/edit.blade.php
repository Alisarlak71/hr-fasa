@php use Morilog\Jalali\Jalalian; @endphp
@extends('dashboard.admin._layout')

@section('title', $title)

@section('head-rest')
    @vite('resources/js/app.js')
@endsection

@section('main')

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    فروشگاه</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">خانه</a>
                    </li>
                    <!--end::item-->
                    <!--begin::item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::item-->
                    <!--begin::item-->
                    <li class="breadcrumb-item text-muted"> محصولات</li>
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
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="d-flex flex-row-fluid me-xl-9 mb-10 mb-xl-0">
                <!--begin::Pos food-->
                <!--begin::Body-->
                <!--begin::Tap pane-->
                <div class="col-xl-12 mb-xl-10">
                    <!--begin::Table widget 2-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold fs-3 mb-1">ویرایش محصول</span>
                                <span class="text-muted mt-1 fw-semibold fs-7"></span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-3">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <!--begin::Form-->
                                <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row"
                                      data-kt-redirect="#">
                                    <!--begin::کناری column-->
                                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10 border-dotted border-1 border-gray-400 rounded">
                                        <!--begin::نوع-->
                                        <div class="card card-flush ">
                                            <!--begin::کارت header-->
                                            <div class="card-header">
                                                <!--begin::کارت title-->
                                                <div class="card-title">
                                                    <h2>نوع</h2>
                                                </div>
                                                <!--end::کارت title-->
                                                <!--begin::کارت toolbar-->

                                                <!--begin::کارت toolbar-->
                                            </div>
                                            <!--end::کارت header-->
                                            <!--begin::کارت body-->
                                            <div class="card-body pt-0">
                                                <!--begin::انتخاب2-->
                                                <select class="form-select mb-2" name="product_type"
                                                        data-control="select2" data-hide-search="true"
                                                        data-placeholder="انتخاب "
                                                        id="kt_ecommerce_add_product_status_select">
                                                    <option></option>
                                                    <option value="1" {{$product->type==\App\Enums\ProductType::COMMODITY?'selected':''}}>
                                                        کالا
                                                    </option>
                                                    <option value="2" {{$product->type==\App\Enums\ProductType::SERVICE?'selected':''}}>
                                                        خدمات
                                                    </option>

                                                </select>
                                                <!--end::انتخاب2-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">نوع محصول را تنظیم کنید.</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::کارت body-->
                                        </div>
                                        <!--end::نوع-->
                                        <!--begin::دسته بندی & tags-->
                                        <div class="card card-flush ">
                                            <!--begin::کارت header-->
                                            <div class="card-header">
                                                <!--begin::کارت title-->
                                                <div class="card-title">
                                                    <h2>جزییات محصول</h2>
                                                </div>
                                                <!--end::کارت title-->
                                            </div>
                                            <!--end::کارت header-->
                                            <!--begin::کارت body-->
                                            <div class="card-body pt-0">
                                                <!--begin::Input group-->
                                                <!--begin::Tags-->
                                                <label class="form-label">دسته بندی ها</label>
                                                <!--end::Tags-->
                                                <!--begin::انتخاب2-->
                                                <select class="form-select mb-2" data-control="select2"
                                                        autocomplete="off"
                                                        name="category_id"
                                                        data-placeholder="انتخاب " data-allow-clear="true">
                                                    <option></option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" {{$product->category_id==$category->id?'selected':''}}>{{$category->title}}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::انتخاب2-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7 mb-7">دسته بندی محصول</div>
                                                <!--end::توضیحات-->
                                                <!--end::Input group-->
                                                <!--begin::Button-->
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#createCategoryModal"
                                                   class="btn btn-light-primary btn-sm mb-10">
                                                    <i class="ki-duotone ki-plus fs-2"></i>دسته بندی جدید</a>
                                                <!--end::Button-->

                                            </div>
                                            <!--end::کارت body-->
                                        </div>
                                        <!--end::دسته بندی & tags-->
                                        <!--begin::Thumbnail settings-->
                                        <div class="card card-flush ">
                                            <!--begin::کارت header-->
                                            <div class="card-header">
                                                <!--begin::کارت title-->
                                                <div class="card-title">
                                                    <h2>تصویر شاخص</h2>
                                                </div>
                                                <!--end::کارت title-->
                                            </div>
                                            <!--end::کارت header-->
                                            <!--begin::کارت body-->
                                            <div class="card-body text-center pt-0">
                                                <!--begin::Image input-->
                                                <!--begin::Image input placeholder-->
                                                <style>.image-input-placeholder {
                                                        background-image: url('{{$product->image->download_link??asset('/assets/media/svg/files/blank-image.svg')}}');
                                                    }

                                                    [data-bs-theme="dark"] .image-input-placeholder {
                                                        background-image: url('{{$product->image->download_link??asset('/assets/media/svg/files/blank-image.svg')}}');
                                                    }
                                                </style>
                                                <!--end::Image input placeholder-->
                                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                                     data-kt-image-input="true">
                                                    <!--begin::نمایش existing avatar-->
                                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                                    <!--end::نمایش existing avatar-->
                                                    <!--begin::Tags-->
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                           data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                           title="تعویض آواتار">
                                                        <i class="ki-duotone ki-pencil fs-7">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <!--begin::Inputs-->
                                                        <input id="change_thumbnail" type="file" name="avatar"
                                                               accept=".png, .jpg, .jpeg"/>
                                                        <input type="hidden" name="avatar_remove"/>
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Tags-->
                                                </div>
                                                <!--end::Image input-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">فرمت های مجاز عبارتند از *.png, *.jpg
                                                    *.jpeg
                                                </div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::کارت body-->
                                        </div>
                                        <!--end::Thumbnail settings-->
                                        <!--begin::وضعیت-->
                                        <div class="card card-flush ">
                                            <!--begin::کارت header-->
                                            <div class="card-header">
                                                <!--begin::کارت title-->
                                                <div class="card-title">
                                                    <h2>وضعیت</h2>
                                                </div>
                                                <!--end::کارت title-->
                                                <!--begin::کارت toolbar-->
                                                <div class="card-toolbar">
                                                    <div class="rounded-circle bg-success w-15px h-15px"
                                                         id="kt_ecommerce_add_product_status"></div>
                                                </div>
                                                <!--begin::کارت toolbar-->
                                            </div>
                                            <!--end::کارت header-->
                                            <!--begin::کارت body-->
                                            <div class="card-body pt-0">
                                                <!--begin::انتخاب2-->
                                                <select class="form-select mb-2" name="product_status"
                                                        data-control="select2" data-hide-search="true"
                                                        data-placeholder="انتخاب "
                                                        id="kt_ecommerce_add_product_status_select">
                                                    <option></option>
                                                    <option value="2" {{$product->status === \App\Enums\PublishStatuses::PUBLISHED?'selected':''}}>
                                                        منتشر شده
                                                    </option>
                                                    <option value="1" {{$product->status === \App\Enums\PublishStatuses::DRAFTED?'selected':''}}>
                                                        پیش نویس
                                                    </option>
                                                </select>
                                                <!--end::انتخاب2-->
                                                <!--begin::توضیحات-->
                                                <div class="text-muted fs-7">وضعیت محصول را تنظیم کنید.</div>
                                                <!--end::توضیحات-->
                                            </div>
                                            <!--end::کارت body-->
                                        </div>
                                        <!--end::وضعیت-->
                                    </div>
                                    <!--end::کناری column-->
                                    <!--begin::اصلی column-->
                                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 border-dotted border-1 border-gray-400 rounded">
                                        {{--                                        <!--begin:::Tabs-->--}}
                                        {{--                                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">--}}
                                        {{--                                            <!--begin:::Tab item-->--}}
                                        {{--                                            <li class="nav-item">--}}
                                        {{--                                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"--}}
                                        {{--                                                   href="#kt_ecommerce_add_product_general">عمومی</a>--}}
                                        {{--                                            </li>--}}
                                        {{--                                            <!--end:::Tab item-->--}}
                                        {{--                                        </ul>--}}
                                        <!--end:::Tabs-->
                                        <!--begin::Tab content-->
                                        <div class="tab-content">
                                            <!--begin::Tab pane-->
                                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general"
                                                 role="tab-panel">
                                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                                    <!--begin::عمومی options-->
                                                    <div class="card card-flush py-4">
                                                        {{--                                                        <!--begin::کارت header-->--}}
                                                        {{--                                                        <div class="card-header">--}}
                                                        {{--                                                            <div class="card-title">--}}
                                                        {{--                                                                <h2>عمومی</h2>--}}
                                                        {{--                                                            </div>--}}
                                                        {{--                                                        </div>--}}
                                                        {{--                                                        <!--end::کارت header-->--}}
                                                        <!--begin::کارت body-->
                                                        <div class="card-body pt-0">
                                                            <!--begin::Input group-->
                                                            <div class="mb-10 fv-row">
                                                                <!--begin::Tags-->
                                                                <label class="required form-label">نام</label>
                                                                <!--end::Tags-->
                                                                <!--begin::Input-->
                                                                <input type="text" name="product_title"
                                                                       class="form-control mb-2" placeholder="نام محصول"
                                                                       value="{{$product->title}}"/>
                                                                <!--end::Input-->
                                                                <!--begin::توضیحات-->
                                                                <div class="text-muted fs-7">حداقل 5 حرف</div>
                                                                <!--end::توضیحات-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div>
                                                                <!--begin::Tags-->
                                                                <label class="form-label">توضیحات</label>
                                                                <!--end::Tags-->
                                                                <!--begin::or-->
                                                                <div id="kt_ecommerce_add_product_description"
                                                                     name="kt_ecommerce_add_product_description"
                                                                     class="min-h-200px mb-2"
                                                                     data-value="{{$product->short_description}}">
                                                                </div>
                                                                <!--end::or-->
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                        <!--end::کارت header-->
                                                    </div>
                                                    <!--end::عمومی options-->

                                                    <!--begin::قیمت گذاری-->
                                                    <div class="card card-flush ">
                                                        <!--begin::کارت header-->
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <h2>قیمت گذاری</h2>
                                                            </div>
                                                        </div>
                                                        <!--end::کارت header-->
                                                        <!--begin::کارت body-->
                                                        <div class="card-body pt-0">
                                                            <!--begin::Input group-->
                                                            <div class="mb-10 fv-row">
                                                                <!--begin::Tags-->
                                                                <label class="required form-label">قیمت پایه</label>
                                                                <!--end::Tags-->
                                                                <!--begin::Input-->
                                                                <input type="text" name="product_price"
                                                                       class="form-control mb-2"
                                                                       placeholder="قیمت محصول"
                                                                       value="{{$product->price}}"/>
                                                                <!--end::Input-->
                                                                <!--begin::توضیحات-->
                                                                <div class="text-muted fs-7">قیمت محصول را وارد کنید
                                                                </div>
                                                                <!--end::توضیحات-->
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                        <!--end::کارت header-->
                                                    </div>
                                                    <!--end::قیمت گذاری-->
                                                    <div class="card-footer">
                                                        <div class="d-flex justify-content-end">
                                                            <!--begin::Button-->
                                                            <button id="kt_ecommerce_add_product_submit"
                                                                    class="btn btn-primary">
                                                                <span class="indicator-label">ذخیره تغییرات</span>
                                                                <span class="indicator-progress">لطفا صبر کنید...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                            </button>
                                                            <!--end::Button-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Tab pane-->
                                        </div>
                                        <!--end::Tab content-->

                                    </div>
                                    <!--end::اصلی column-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--end::Table widget 2-->
                </div>
                <!--end::Tap pane-->

                <!--end::Pos food-->
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
    <!--begin::Modal body-->

    <!--begin::Modal body-->
    <div id="createCategoryModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>ایجاد دسته بندی</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_new_card_form" class="form" action="#">
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Tags-->
                            <label class="fs-6 fw-semibold form-label mb-2">نام دسته بندی</label>
                            <!--end::Tags-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <!--begin::Input-->
                                <input type="text" id="category_name" class="form-control form-control-solid"
                                       placeholder="نام دسته بندی" name="name"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" data-bs-dismiss="modal" id="kt_modal_new_card_cancel"
                                    class="btn btn-light me-3">لغو
                            </button>
                            <button id="confirmCategory" type="submit" class="btn btn-primary">
                                <span class="indicator-label">تایید</span>
                                <span class="indicator-progress">لطفا صبر کنید...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal body-->
    <script>
        $(document).ready(function () {
            let thumbnail_id = {{$product->image->id??0}};
            $("#change_thumbnail").change(function (e) {
                let formData = new FormData();
                let file = $("#change_thumbnail")[0].files[0];
                formData.append('file', file);
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('directory', 'products');

                Swal.showLoading();
                $.ajax({
                    url: '/files',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire(
                            {
                                type: 'success',
                                text: 'تصویر با موفقیت اضافه شد!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        thumbnail_id = response.file[0].id;
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            Swal.fire(
                                {
                                    title: 'خطا',
                                    type: 'error',
                                    text: xhr.responseJSON.errors.file[0],
                                    confirmButtonText: 'باشه'
                                });
                        } else {
                            Swal.fire(
                                {
                                    title: 'خطا',
                                    type: 'error',
                                    text: xhr.responseJSON.error || 'خطای سرور ',
                                    confirmButtonText: 'باشه'
                                });
                        }
                    }
                });
            });

            $("#kt_ecommerce_add_product_submit").on('click', function (e) {
                e.preventDefault();
                const submitElement = $(this);
                const form = $("#kt_ecommerce_add_product_form");
                const title = form.find('input[name="product_title"]').val();
                const description = form.find('div[class="ql-editor"]').html();
                const type = form.find('select[name="product_type"]').val();
                const category_id = form.find('select[name="category_id"]').val();
                const price = form.find('input[name="product_price"]').val();
                const status = form.find('select[name="product_status"]').val();


                showProgressButton(submitElement);
                $.ajax({
                    url: '/admin/products/'+{{$product->id}},
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        "title": title,
                        "description": description,
                        "type": type,
                        "category_id": category_id,
                        "price": price,
                        "status": status,
                        "image_id": thumbnail_id,
                    },
                    success: function () {
                        Swal.fire(
                            {
                                type: 'success',
                                text: 'محصول با موفقیت ویرایش شد!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        hideProgressButton(submitElement);

                        setTimeout(() => {
                            window.location.reload();
                        }, 2000)
                    },
                    error: function (xhr) {
                        hideProgressButton(submitElement);
                        if (xhr.status === 422) {
                            Swal.fire(
                                {
                                    title: 'خطا',
                                    type: 'error',
                                    text: xhr.responseJSON.errors.title || xhr.responseJSON.errors.description ||
                                        xhr.responseJSON.errors.price || xhr.responseJSON.errors.status ||
                                        xhr.responseJSON.errors.category_id || xhr.responseJSON.errors.image_id,
                                    confirmButtonText: 'باشه'
                                });
                        } else {
                            Swal.fire(
                                {
                                    title: 'خطا',
                                    type: 'error',
                                    text: xhr.responseJSON.error || 'خطای سرور ',
                                    confirmButtonText: 'باشه'
                                });
                        }
                    }
                });
            });
            $("#confirmCategory").on('click', function (e) {
                e.preventDefault();
                let thisElement = $(this);
                let category_name = $('#category_name');
                const form = $("#kt_ecommerce_add_product_form");
                const category_select = form.find('select[name="category_id"]');
                showProgressButton(thisElement);
                $.ajax({
                    url: '/admin/categories',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        "name": category_name.val(),
                    },
                    success: function (response) {
                        hideProgressButton(thisElement);
                        $("#createCategoryModal").modal('hide');
                        category_name.val('');
                        category_select.append(`<option value="${response.category.id}">${response.category.title}</option>`)
                        Swal.fire(
                            {
                                type: 'success',
                                text: 'دسته بندی با موفقیت ثبت شد',
                                showConfirmButton: false,
                                timer: 1500
                            });
                    },
                    error: function (xhr) {
                        hideProgressButton(thisElement);
                        if (xhr.status === 422) {
                            Swal.fire(
                                {
                                    title: 'خطا',
                                    type: 'error',
                                    text: xhr.responseJSON.errors.name,
                                    confirmButtonText: 'باشه'
                                });
                        } else {
                            Swal.fire(
                                {
                                    title: 'خطا',
                                    type: 'error',
                                    text: xhr.responseJSON.error || 'خطای سرور ',
                                    confirmButtonText: 'باشه'
                                });
                        }
                    }
                });
            });
        });
    </script>

@endsection
@section('scripts')
    @parent
    <script src="https://unpkg.com/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
    <script src="{{asset('/assets/js/custom/apps/ecommerce/catalog/edit-product.js')}}"></script>
    <script src="{{asset('/assets/js/custom/apps/ecommerce/catalog/save-category.js')}}"></script>

@endsection