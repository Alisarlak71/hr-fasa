@extends('dashboard.admin._layout')

@section('title', $title)


@section('main')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">

                    شرکت ها</h1>
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
                    <li class="breadcrumb-item text-muted"> لیست شرکت ها</li>
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
            <div class="col-xl-10">
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1"> لیست شرکت ها </span>
                            <span class="text-muted mt-1 fw-semibold fs-7"></span>
                        </h3>
                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="Click to add a user" data-kt-initialized="1">
                            <a href="#" class="btn btn-sm btn-light btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_company">
                                <i class="ki-duotone ki-plus fs-2"></i>شرکت جدید</a>
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
                                    <th class="p-0 min-w-70px">شناسه</th>
                                    <th class="p-0">نام</th>
                                    <th class="p-0">تاریخ ثبت در سیستم</th>
                                    <th class="p-0">وضعیت</th>
                                    <th class="p-0">عملیات</th>
                                </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="transaction_table" id="transaction_table">
                                @foreach($companies as $company)
                                    <tr>
                                        <td class="text-muted">
                                            {{$company->id}}
                                        </td>
                                        <td class="text-muted">
                                            {{$company->name}}
                                        </td>
                                        <td class="text-muted">
                                            {{$company->created_at}}
                                        </td>
                                        <td id="status_file_uploaded-{{$company->id}}">
                                            @switch($company->status??null)
                                                @case(\App\Enums\CompanyStatuses::ACTIVATED)
                                                    <span
                                                        class="badge badge-light-success">فعال</span>
                                                    @break
                                                @case(\App\Enums\CompanyStatuses::DEACTIVATED)
                                                    <span
                                                        class="badge badge-light-danger">غیرفعال</span>
                                                    @break
                                            @endswitch

                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start flex-shrink-0">
                                                <a href="#" data-bs-toggle="tooltip" title="تغییر وضعیت (فعال/غیرفعال)"
                                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 toggle_status_company"
                                                   data-id="{{$company->id}}">
                                                    <i class="ki-duotone ki-switch fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </a>
                                                <a href="#" data-bs-toggle="tooltip" title="ویرایش"
                                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit_company"
                                                   data-id="{{$company->id}}">
                                                    <i class="ki-duotone ki-pencil fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </a>
                                                <a href="#"  data-bs-toggle="tooltip" title="حذف شرکت"
                                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete_company"
                                                   data-id="{{$company->id}}">
                                                    <i class="ki-duotone ki-trash fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                                <!--end::Table body-->
                            </table>

                            <!--end::Table-->
                        </div>
                        {{ $companies->links('pagination::bootstrap-5') }}
                        <!--end::Table container-->
                    </div>

                    <!--begin::Body-->
                </div>
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

    <!--begin::Modal body-->
    <div id="updateCompanyModal" class="modal fade updateCompanyModal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>ویرایش شرکت</h2>
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
                            <label class="fs-6 fw-semibold form-label mb-2">نام شرکت</label>
                            <!--end::Tags-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <!--begin::Input-->
                                <input type="text" id="companyName" class="form-control form-control-solid"
                                       placeholder="نام شرکت" name="code"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">لغو</button>
                            <button id="updateCompanyButton" type="submit" class="btn btn-primary">
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

    <!--begin::Modal body-->
    <div id="kt_modal_create_company" class="modal fade updateCompanyModal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>ایجاد شرکت</h2>
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
                            <label class="fs-6 fw-semibold form-label mb-2">نام شرکت</label>
                            <!--end::Tags-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <!--begin::Input-->
                                <input type="text" id="CreateCompanyName" class="form-control form-control-solid"
                                       placeholder="نام شرکت" name="code"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">لغو</button>
                            <button id="createCompanyButton" type="submit" class="btn btn-primary">
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
        setTimeout(() => {
            window.Echo.channel('transactionImport')
                .listen('ImportDataProcessed', (e) => {
                    console.log(e.data);
                });
        }, 1000);
    </script>

    <script>
        $(document).ready(function () {
            $('.toggle_status_company').on('click', function () {

                $.ajax({
                        url: `/admin/companies/${$(this).attr('data-id')}/toggle_status`,
                        type: 'GET',
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            Swal.fire(
                                {
                                    type: 'success',
                                    text: 'وضعیت با موفقیت تغییر کرد!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000)
                        },
                        error: function (xhr, status, error) {
                            if (xhr.status === 422) {
                                Swal.fire(
                                    {
                                        title: 'خطا',
                                        type: 'error',
                                        text: xhr.responseJSON.errors.name || xhr.responseJSON.errors.cellphone || xhr.responseJSON.errors.email,
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
                    }
                );
            });

            $('.edit_company').on('click', function () {
                let id = $(this).data('id');

                $('#updateCompanyModal').modal('show');
                $(".updateCompanyModal #updateCompanyButton").attr('data-id', id);
            });

            $('#updateCompanyButton').on('click', function (e) {
                e.preventDefault();
                let thisElement = $(this);
                let name = $("#companyName");
                showProgressButton(thisElement);
                $.ajax({
                        url: `/admin/companies/${thisElement.data('id')}`,
                        type: 'PUT',
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {"name": name.val()},
                        success: function (response) {
                            Swal.fire(
                                {
                                    type: 'success',
                                    text: 'نام با موفقیت تغییر کرد!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            hideProgressButton();

                            setTimeout(() => {
                                window.location.reload();
                            }, 2000)
                        },
                        error: function (xhr, status, error) {
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
                            hideProgressButton(thisElement);
                        }
                    }
                );
            });

            $('#createCompanyButton').on('click', function (e) {
                e.preventDefault();
                let thisElement = $(this);
                let name = $("#CreateCompanyName");
                showProgressButton(thisElement);
                $.ajax({
                        url: `/admin/companies`,
                        type: 'POST',
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {"name": name.val()},
                        success: function (response) {
                            Swal.fire(
                                {
                                    type: 'success',
                                    text: 'شرکت با موفقیت اضافه شد!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            hideProgressButton();

                            setTimeout(() => {
                                window.location.reload();
                            }, 2000)
                        },
                        error: function (xhr, status, error) {
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
                            hideProgressButton(thisElement);
                        }
                    }
                );
            });

            $('.delete_company').on('click', function () {
                let thisElement = $(this);
                Swal.fire(
                    {
                        title: 'حذف شرکت',
                        type: 'warning',
                        text: 'آیا از حذف شرکت مطمین هستید؟',
                        confirmButtonText: 'تایید',
                        cancelButtonText: 'لغو',
                        showCancelButton: true,
                        closeOnConfirm: false,
                        closeOnCancel: true
                    }).then(function (result){
                        console.log(result.isConfirmed)
                        if(result.isConfirmed){
                            $.ajax({
                                url: `/admin/companies/${thisElement.data('id')}`,
                                type: 'DELETE',
                                dataType: 'JSON',
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                success: function (response) {
                                    Swal.fire(
                                        {
                                            type: 'success',
                                            text: 'شرکت با موفقیت حذف شد!',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    hideProgressButton();

                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 2000)
                                },
                                error: function (xhr, status, error) {
                                    if (xhr.status === 404) {
                                        Swal.fire(
                                            {
                                                title: 'خطا',
                                                type: 'error',
                                                text: 'شرکت مورد نظر یافت نشد!',
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
