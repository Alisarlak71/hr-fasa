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
                    <li class="breadcrumb-item text-muted">سفارش ها</li>
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
                                <span class="card-label fw-bold fs-3 mb-1">لیست تراکنش ها</span>
                                <span class="text-muted mt-1 fw-semibold fs-7"></span>
                            </h3>
                            <div class="card-toolbar" data-select2-id="select2-data-125-gbfu">
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
                                    <form action="/admin/orders" method="get" class="px-7 py-5"
                                          data-select2-id="select2-data-124-c2dr">
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
                                                    @foreach( \App\Enums\OrderStatuses::values() as $status)
                                                        <option value="{{$status}}">{{getStatusLabel($status)}}</option>
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
                                                <form action="/admin/orders">
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
                                                <span>کاربر</span>
                                                <form action="/admin/orders">
                                                    <input name="sorts[user.name]"
                                                           value="{{!empty($_GET['sorts']['user.name'])&&$_GET['sorts']['user.name']==='asc'?'desc':'asc'}}"
                                                           type="hidden"/>
                                                    <a href="#"
                                                       class="submit-link btn btn-sm btn-icon btn-bg {{!empty($_GET['sorts']['user.name'])&&$_GET['sorts']['user.name']==='asc'?'btn-color-danger':'btn-color-white'}}">
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
                                                <span>مبلغ کل</span>
                                                <form action="/admin/orders">
                                                    <input name="sorts[total_price]"
                                                           value="{{!empty($_GET['sorts']['total_price'])&&$_GET['sorts']['total_price']==='asc'?'desc':'asc'}}"
                                                           type="hidden"/>
                                                    <a href="#"
                                                       class="submit-link btn btn-sm btn-icon btn-bg {{!empty($_GET['sorts']['total_price'])&&$_GET['sorts']['total_price']==='asc'?'btn-color-danger':'btn-color-white'}}">
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
                                                <form action="/admin/orders">
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
                                                <form action="/admin/orders">
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
                                    <tbody class="transaction_table" id="transaction_table">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="text-muted">
                                                <a href="/orders/{{$order->id}}">{{$order->id}}</a>
                                            </td>
                                            <td class="text-muted">
                                                {{$order->user->name}}
                                            </td>
                                            <td class="text-muted">
                                                {{$order->total_price}}
                                            </td>
                                            <td class="text-muted">
                                                {{Jalalian::forge($order->created_at)->format('%A, %d %B %Y - H:i')}}
                                            </td>
                                            <td class="text-muted">
                                                <span class="badge {{getStatusBadgeClass($order->status) }}">{{getStatusLabel($order->status) }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center flex-shrink-0 fc-direction-ltr">
                                                    @if($order->status === \App\Enums\OrderStatuses::WAIT_FOR_PAYMENT)

                                                        <a href="#"  data-bs-toggle="tooltip" title="لفو سفارش" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 change_order_status" data-id="{{$order->id}} ">
                                                            <i class="ki-duotone ki-delete-folder fs-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                        </a>
                                                        <a href="/orders/{{$order->id}}"  data-bs-toggle="tooltip" title="پرداخت صورت حساب" class="btn btn-icon btn-bg-light btn-active-color-info btn-sm me-1" >
                                                            <i class="ki-duotone ki-check-square fs-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                                <span class="path4"></span>
                                                            </i>
                                                        </a>

                                                    @else
                                                        <a href="/orders/{{$order->id}}"  data-bs-toggle="tooltip" title="مشاهده جزییات" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                                                            <i class="ki-duotone ki-eye fs-2">
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
                        {{ $orders->links('pagination::bootstrap-5') }}

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
            $(".change_order_status").on('click', function () {
                let id = $(this).attr('data-id');
                Swal.fire(
                    {
                        title: 'لغو سفارش',
                        type: 'warning',
                        text: 'آیا از لغو سفارش مطمین هستید؟',
                        confirmButtonText: 'تایید',
                        cancelButtonText: 'لغو',
                        showCancelButton: true,
                        closeOnConfirm: false,
                        closeOnCancel: true
                    }).then(function (result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/orders/' + id,
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function () {
                                Swal.fire(
                                    {
                                        type: 'success',
                                        text: 'سفارش با موفقیت لغو شد!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                hideProgressButton();

                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000)
                            },
                            error: function (xhr) {
                                if (xhr.status === 422 || xhr.status === 403) {
                                    Swal.fire(
                                        {
                                            title: 'خطا',
                                            type: 'error',
                                            text: xhr.responseJSON.errors.name || xhr.responseJSON.errors.cellphone ||
                                                xhr.responseJSON.errors.email || xhr.responseJSON.errors.is_admin ||
                                                xhr.responseJSON.errors.company_id || xhr.responseJSON.message,
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
