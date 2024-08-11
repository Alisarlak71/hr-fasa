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
                                <span class="card-label fw-bold fs-3 mb-1">لیست  محصولات</span>
                                <span class="text-muted mt-1 fw-semibold fs-7"></span>
                            </h3>

                            <div class="card-toolbar" data-select2-id="select2-data-125-gbfu">
                                <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="Click to add a user" data-kt-initialized="1">
                                    <a href="/admin/products/create" class="btn btn-sm btn-light btn-primary" >
                                        <i class="ki-duotone ki-plus fs-2"></i>محصول جدید</a>
                                </div>
                                <!--begin::Menu-->
                                <button type="button"
                                        class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-category fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                     id="kt_menu_64b776349d4d2" style=""
                                     data-select2-id="select2-data-kt_menu_64b776349d4d2">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">فیلتر</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <form action="/admin/products" method="get" class="px-7 py-5"
                                          data-select2-id="select2-data-124-c2dr">
                                        <div class="mb-10" data-select2-id="select2-data-123-kno3">
                                            <!--begin::Tags-->
                                            <label class="form-label fw-semibold">عنوان :</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <input class="form-control" type="text"
                                                   name="filters[title]"/>
                                            <!--end::Input-->
                                        </div>

                                        <!--begin::Input group-->
                                        <div class="mb-10" data-select2-id="select2-data-123-kno3">
                                            <!--begin::Tags-->
                                            <label class="form-label fw-semibold">وضعیت:</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <div data-select2-id="select2-data-122-tnen">
                                                <select name="filters[status]" aria-label=""
                                                        data-control="select2"
                                                        data-placeholder="انتخاب وضعیت "
                                                        value="{{$_GET['status']??''}}"
                                                        class="form-select form-select-solid form-select-lg fw-semibold">
                                                    <option data-select2-id="select2-data-132-52o7"></option>
                                                    <option value="0">انتخاب همه</option>
                                                    @foreach( \App\Enums\PublishStatuses::values() as $status)
                                                        <option value="{{$status}}">{{($status===\App\Enums\PublishStatuses::PUBLISHED?'منتشر شده':'پیش نویس')}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10" data-select2-id="select2-data-123-kno3">
                                            <!--begin::Tags-->
                                            <label class="form-label fw-semibold">از تاریخ:</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <input class="form-control" data-jdp
                                                   name="filters[created_at][operator][>=]">
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10" data-select2-id="select2-data-123-kno3">
                                            <!--begin::Tags-->
                                            <label class="form-label fw-semibold">تا تاریخ:</label>
                                            <!--end::Tags-->
                                            <!--begin::Input-->
                                            <input class="form-control " data-jdp
                                                   name="filters[created_at][operator][<=]">
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                    data-kt-menu-dismiss="true">تایید
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-3">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                    <tr class="border-0">
                                        <th class="p-0 min-w-70px">
                                            <div class="d-flex justify-content-center text-center">
                                                <span>شناسه</span>
                                                <form action="/admin/products">
                                                    <input name="sorts[id]"
                                                           value="{{!empty($_GET['sorts']['id'])&&$_GET['sorts']['id']==='asc'?'desc':'asc'}}"
                                                           type="hidden"/>
                                                    <a href="#"
                                                       class="submit-link btn btn-sm btn-icon btn-bg {{!empty($_GET['sorts']['id'])&&$_GET['sorts']['id']==='asc'?'btn-color-danger':'btn-color-white'}}">
                                                        <i class="ki-duotone ki-arrow-up-down fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                </form>
                                            </div>
                                        </th>
                                        <th class="p-0 min-w-70px">
                                            <div class="d-flex justify-content-center text-center">
                                                <span>نام محصول</span>
                                                <form action="/admin/products">
                                                    <input name="sorts[title]"
                                                           value="{{!empty($_GET['sorts']['title'])&&$_GET['sorts']['title']==='asc'?'desc':'asc'}}"
                                                           type="hidden"/>
                                                    <a href="#"
                                                       class="submit-link btn btn-sm btn-icon btn-bg {{!empty($_GET['sorts']['title'])&&$_GET['sorts']['title']==='asc'?'btn-color-danger':'btn-color-white'}}">
                                                        <i class="ki-duotone ki-arrow-up-down fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                </form>
                                            </div>
                                        </th>
                                        <th class="p-0 min-w-70px">
                                            <div class="d-flex justify-content-center text-center">
                                                <span>مبلغ </span>
                                                <form action="/admin/products">
                                                    <input name="sorts[price]"
                                                           value="{{!empty($_GET['sorts']['price'])&&$_GET['sorts']['price']==='asc'?'desc':'asc'}}"
                                                           type="hidden"/>
                                                    <a href="#"
                                                       class="submit-link btn btn-sm btn-icon btn-bg {{!empty($_GET['sorts']['price'])&&$_GET['sorts']['price']==='asc'?'btn-color-danger':'btn-color-white'}}">
                                                        <i class="ki-duotone ki-arrow-up-down fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                </form>
                                            </div>
                                        </th>
                                        <th class="p-0 min-w-70px">
                                            <div class="d-flex justify-content-center text-center">
                                                <span>تاریخ ایجاد</span>
                                                <form action="/admin/products">
                                                    <input name="sorts[created_at]"
                                                           value="{{!empty($_GET['sorts']['created_at'])&&$_GET['sorts']['created_at']==='asc'?'desc':'asc'}}"
                                                           type="hidden"/>
                                                    <a href="#"
                                                       class="submit-link btn btn-sm btn-icon btn-bg {{!empty($_GET['sorts']['created_at'])&&$_GET['sorts']['created_at']==='asc'?'btn-color-danger':'btn-color-white'}}">
                                                        <i class="ki-duotone ki-arrow-up-down fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                </form>
                                            </div>
                                        </th>
                                        <th class="p-0 min-w-70px">
                                            <div class="d-flex justify-content-center text-center">
                                                <span>وضعیت</span>
                                                <form action="/admin/products">
                                                    <input name="sorts[status]"
                                                           value="{{!empty($_GET['sorts']['status'])&&$_GET['sorts']['status']==='asc'?'desc':'asc'}}"
                                                           type="hidden"/>
                                                    <a href="#"
                                                       class="submit-link btn btn-sm btn-icon btn-bg {{!empty($_GET['sorts']['status'])&&$_GET['sorts']['status']==='asc'?'btn-color-danger':'btn-color-white'}}">
                                                        <i class="ki-duotone ki-arrow-up-down fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                </form>
                                            </div></th>
                                        <th class="p-0 min-w-175px">عملیات</th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-semibold text-gray-600">
                                    @foreach($products as $product)
                                    <tr>
                                        <td class="text-center">
                                            {{$product->id}}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <!--begin::Thumbnail-->
                                                <a href="/admin/products/{{$product->id}}/edit" class="symbol symbol-50px">
                                                    <span class="symbol-label" style="background-image:url({{$product->image->download_link??asset('assets/media/no-image-icon.png')}});"></span>
                                                </a>
                                                <!--end::Thumbnail-->
                                                <div class="ms-5">
                                                    <!--begin::Title-->
                                                    <a href="/admin/products/{{$product->id}}/edit" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name">{{$product->title}}</a>
                                                    <!--end::Title-->
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center pe-0">
                                            <span class="fw-bold">{{$product->price}}</span>
                                        </td>
                                        <td class="text-center pe-0">
                                            <span class="fw-bold">{{Jalalian::forge($product->created_at)->format('%y/%m/%d - h:m')}}</span>
                                        </td>
                                        <td class="text-end pe-0" >
                                            <!--begin::Badges-->
                                            @if($product->status === \App\Enums\PublishStatuses::DRAFTED)
                                                <div class="badge badge-light-warning">پیش نویس</div>
                                            @else
                                                <div class="badge badge-light-success">منتشر شده</div>
                                            @endif
                                            <!--end::Badges-->
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center flex-shrink-0 fc-direction-ltr">
                                                    <a href="#"  data-bs-toggle="tooltip" title="حذف محصول" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_product" data-id="{{$product->id}}">
                                                        <i class="ki-duotone ki-trash fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                        </i>
                                                    </a>
                                                    <a href="/admin/products/{{$product->id}}/edit"  data-bs-toggle="tooltip" title="ویرایش محصول" class="btn btn-icon btn-bg-light btn-active-color-info btn-sm me-1" data-id="{{$product->id}}" >
                                                        <i class="ki-duotone ki-pencil fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                        </i>
                                                    </a>
                                                @if($product->status === \App\Enums\PublishStatuses::DRAFTED)
                                                <a href="#"  data-bs-toggle="tooltip" title="انتشار" class="btn btn-icon btn-bg-light btn-active-color-info btn-sm me-1 publish_product" data-id="{{$product->id}}">
                                                    <i class="ki-duotone ki-check-square fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                    </i>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>


                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        {{ $products->links('pagination::bootstrap-5') }}

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
    <script>
        $(document).ready(function () {
            $(".delete_product").on('click', function () {
                let id = $(this).attr('data-id');
                Swal.fire(
                    {
                        title: 'حذف محصول',
                        type: 'warning',
                        text: 'آیا از حذف محصول مطمین هستید؟',
                        confirmButtonText: 'تایید',
                        cancelButtonText: 'لغو',
                        showCancelButton: true,
                        closeOnConfirm: false,
                        closeOnCancel: true
                    }).then(function (result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/admin/products/' + id,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function () {
                                Swal.fire(
                                    {
                                        type: 'success',
                                        text: 'محصول با موفقیت حذف شد!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                hideProgressButton();

                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000)
                            },
                            error: function (xhr) {
                                if ( xhr.status === 403||xhr.status === 404) {
                                    Swal.fire(
                                        {
                                            title: 'خطا',
                                            type: 'error',
                                            text:  xhr.responseJSON.message,
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
                    }
                });
            });
            $(".publish_product").on('click', function () {
                let id = $(this).attr('data-id');
                Swal.fire(
                    {
                        title: ' انتشار محصول',
                        type: 'warning',
                        text: 'آیا از انتشار محصول مطمین هستید؟',
                        confirmButtonText: 'تایید',
                        cancelButtonText: 'لغو',
                        showCancelButton: true,
                        closeOnConfirm: false,
                        closeOnCancel: true
                    }).then(function (result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/admin/products/' + id+'/publish',
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function () {
                                Swal.fire(
                                    {
                                        type: 'success',
                                        text: 'محصول با موفقیت منتشر شد!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                hideProgressButton();

                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000)
                            },
                            error: function (xhr) {
                                if (xhr.status === 404 || xhr.status === 403) {
                                    Swal.fire(
                                        {
                                            title: 'خطا',
                                            type: 'error',
                                            text: xhr.responseJSON.message,
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
                                hideProgressButton(thisElement);
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
