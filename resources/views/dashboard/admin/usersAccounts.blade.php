@extends('dashboard.admin._layout')

@section('title', $title)

@section('head-rest')
    <style>
        .copy {
            cursor: copy;
        }

        .copy:hover {
            color: #0c1e33;
            font-weight: bold;
        }
    </style>
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
                    کاربر ها</h1>
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
                    <li class="breadcrumb-item text-muted"> لیست کاربران</li>
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
                            <span class="card-label fw-bold fs-3 mb-1"> لیست حساب های کاربران</span>
                            <span class="text-muted mt-1 fw-semibold fs-7"></span>
                        </h3>
                        <a class="btn-primary" href="{{ url('admin/users/account_number/export') }}">
                            خروجی اکسل
                        </a>
                        {{--<div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top"
                             data-bs-trigger="hover" data-bs-original-title="Click to add a user"
                             data-kt-initialized="1">
                            <a href="#" class="btn btn-sm btn-light btn-primary" data-bs-toggle="modal"
                               data-bs-target="#kt_modal_create_user">
                                <i class="ki-duotone ki-plus fs-2"></i>کاربر جدید</a>
                        </div>--}}
                    </div>
                    <th class="p-0 min-w-70px">
                        <div class="d-flex align-items-center gap-3 ms-5 flex-wrap">
                            <form action="/admin/users/account_number" method="get">
                                <input name="filter" value="{{$_GET['filter']??''}}" class="form-control"
                                       placeholder="کد پرسنلی">
                            </form>
                            <form action="/admin/users/account_number" method="get">
                                <input name="lname" value="{{$_GET['lname']??''}}" class="form-control"
                                       placeholder="نام خانوادگی">
                            </form>

                        </div>
                    {{--<div>
                        <input name="sort"
                               value="{{!empty($_GET['sort'])&&$_GET['sort']==='asc'?'desc':'asc'}}"
                               type="hidden"/>
                        <a href="#"
                           class="submit-link btn btn-sm btn-icon btn-bg {{!empty($_GET['sort'])&&$_GET['sort']==='asc'?'btn-color-danger':'btn-color-white'}}">
                            <i class="ki-duotone ki-arrow-up-down fs-2">
                                <span class="path1" style="color: darkblue"></span>
                                <span class="path2" style="color: dodgerblue"></span>
                            </i>
                        </a>
                    </div>--}}
                </div>
                </th>
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
                                <th class="">شناسه</th>
                                <th class="">نام</th>
                                <th class="">حساب حقوق</th>
                                <th class="">حساب بن کارت</th>
                                <th>امکان ویرایش</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="transaction_table" id="transaction_table">
                            @foreach($userActs as $ac)
                                <tr>
                                    <td class="text-table">
                                        {{$ac->getUser->id}}
                                    </td>
                                    <td class="text-table">
                                        {{$ac->getUser->name.' '.$ac->getUser->lname}} ({{ $ac->getUser->code }})
                                    </td>
                                    <td class="text-table">
                                        <div class="d-flex">
                                            شبا:
                                            <div class="copy">IR{{ $ac->h_sheba }}</div>
                                        </div>
                                        <div class="d-flex">
                                            حساب:
                                            <div class="copy">{{ $ac->h_sheba }}</div>
                                        </div>
                                        <div class="d-flex">
                                            کارت:
                                            <div class="copy">{{ $ac->h_sheba }}</div>
                                        </div>
                                    </td>
                                    <td class="text-table">
                                        <div class="d-flex">
                                            شبا:
                                            <div class="copy">IR{{ $ac->b_sheba }}</div>
                                        </div>
                                        <div class="d-flex">
                                            حساب:
                                            <div class="copy">{{ $ac->b_sheba }}</div>
                                        </div>
                                        <div class="d-flex">
                                            کارت:
                                            <div class="copy">{{ $ac->b_sheba }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($ac->edit)
                                            <div class="cursor-pointer" onclick="doEdit(0,{{ $ac->id }})">
                                                <i class="fa fa-solid fa-check"></i>
                                                دارد
                                            </div>
                                        @else
                                            <div class="cursor-pointer" onclick="doEdit(1,{{ $ac->id }})">
                                                <i class="fa fa-solid fa-times"></i>
                                                ندارد
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @if(sizeof($userActs) == 0)
                                <tr>
                                    <td colspan="4">
                                        رکوردی یافت نشد
                                    </td>
                                </tr>
                            @endif
                            </tbody>

                            <!--end::Table body-->
                        </table>

                        <!--end::Table-->
                    </div>
                    {{ $userActs->links('pagination::bootstrap-5') }}
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
    <div id="updateUserModal" class="modal fade updateUserModal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>ویرایش کاربر</h2>
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
                            <div>
                                <!--begin::Tags-->
                                <label class="fs-6 fw-semibold form-label mb-2">نام </label>
                                <!--end::Tags-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative">
                                    <!--begin::Input-->
                                    <input type="text" id="userName" class="form-control form-control-solid"
                                           placeholder="نام" name="code"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input wrapper-->
                            </div>
                            <div>
                                <!--begin::Tags-->
                                <label class="fs-6 fw-semibold form-label mb-2">نام </label>
                                <!--end::Tags-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative">
                                    <!--begin::Input-->
                                    <input type="text" id="userlName" class="form-control form-control-solid"
                                           placeholder="نام خانوادگی" name="code"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input wrapper-->
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Tags-->
                            <label class="fs-6 fw-semibold form-label mb-2">شماره تلفن </label>
                            <!--end::Tags-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <!--begin::Input-->
                                <input type="text" id="userCellphone" class="form-control form-control-solid"
                                       placeholder="شماره تلفن" name="code"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        {{--<div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Tags-->
                            <label class="fs-6 fw-semibold form-label mb-2"> ایمیل</label>
                            <!--end::Tags-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <!--begin::Input-->
                                <input type="email" id="userEmail" class="form-control form-control-solid"
                                       placeholder="ایمیل " name="email"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input wrapper-->
                        </div>--}}
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Tags-->
                            <label class="fs-6 fw-semibold form-label mb-2">نقش</label>
                            <!--end::Tags-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <!--begin::Input-->
                                <div class="col-lg-12 fv-row">
                                    <select id="userRole" name="country" aria-label="" data-control="select2"
                                            data-placeholder="انتخاب نقش"
                                            class="form-select form-select-solid form-select-lg fw-semibold">
                                        <option value="0">کاربر</option>
                                        <option value="1">مدیر</option>
                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">لغو</button>
                            <button id="updateUserButton" type="submit" class="btn btn-primary">
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
    <div id="kt_modal_create_user" class="modal fade updateUserModal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>ایجاد کاربر</h2>
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
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Tags-->
                            <label class="fs-6 fw-semibold form-label mb-2">نام </label>
                            <!--end::Tags-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <!--begin::Input-->
                                <input type="text" id="createUserName" class="form-control form-control-solid"
                                       placeholder="نام کاربر" name="code"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Tags-->
                            <label class="fs-6 fw-semibold form-label mb-2">شماره تلفن </label>
                            <!--end::Tags-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <!--begin::Input-->
                                <input type="text" id="createUserCellphone" class="form-control form-control-solid"
                                       placeholder="شماره تلفن" name="code"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        {{-- <div class="d-flex flex-column mb-7 fv-row">
                             <!--begin::Tags-->
                             <label class="fs-6 fw-semibold form-label mb-2"> ایمیل</label>
                             <!--end::Tags-->
                             <!--begin::Input wrapper-->
                             <div class="position-relative">
                                 <!--begin::Input-->
                                 <input type="email" id="createUserEmail" class="form-control form-control-solid"
                                        placeholder="ایمیل " name="code"/>
                                 <!--end::Input-->
                             </div>
                             <!--end::Input wrapper-->
                         </div>--}}
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Tags-->
                            <label class="fs-6 fw-semibold form-label mb-2">نقش</label>
                            <!--end::Tags-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <!--begin::Input-->
                                <div class="col-lg-12 fv-row">
                                    <select id="createUserRole" name="role" aria-label="" data-control="select2"
                                            data-placeholder="انتخاب نقش"
                                            class="form-select form-select-solid form-select-lg fw-semibold">
                                        <option value="0">کاربر</option>
                                        <option value="1">مدیر</option>
                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">لغو</button>
                            <button id="createUserButton" type="submit" class="btn btn-primary">
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

        let copy = document.querySelectorAll(".copy");
        for (const copied of copy) {
            copied.onclick = function () {
                document.execCommand("copy");
            };
            copied.addEventListener("copy", function (event) {
                event.preventDefault();
                if (event.clipboardData) {
                    event.clipboardData.setData("text/plain", copied.textContent);
                    let old = $(this).text();
                    $(this).text('کپی انجام شد');
                    $(this).css('color', 'green');
                    setTimeout(() => {
                        $(this).css('color', 'unset');
                        $(this).text(old);
                    }, 500)
                    //console.log(event.clipboardData.getData("text"))
                }
            });
        }
    </script>

    <script>
        $(document).ready(function () {
            $('.toggle_status_user').on('click', function () {
                $.ajax({
                        url: `/admin/users/${$(this).attr('data-id')}/toggle_status`,
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
                                        text: xhr.responseJSON.errors.name || xhr.responseJSON.errors.lname || xhr.responseJSON.errors.cellphone,
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

            $('.edit_user').on('click', function () {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let lname = $(this).data('lname');
                let cellphone = $(this).data('cellphone');

                $('#updateUserModal').modal('show');
                $(".updateUserModal #updateUserButton").attr('data-id', id);
                $(".updateUserModal #userName").val(name);
                $(".updateUserModal #userlName").val(lname);
                $(".updateUserModal #userCellphone").val(cellphone);
                $(".updateUserModal #userCode").val(code);
            });

            $('#updateUserButton').on('click', function (e) {
                e.preventDefault();
                let thisElement = $(this);
                let name = $("#userName");
                let lname = $("#userlName");
                let cellphone = $("#userCellphone");
                let role = $("#userRole");

                showProgressButton(thisElement);
                $.ajax({
                        url: `/admin/users/${thisElement.data('id')}`,
                        type: 'PUT',
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {
                            "name": name.val(),
                            "lname": name.val(),
                            "cellphone": cellphone.val(),
                            "is_admin": role.val()
                        },
                        success: function (response) {
                            Swal.fire(
                                {
                                    type: 'success',
                                    text: 'کاربر با موفقیت تغییر کرد!',
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
                                        text: xhr.responseJSON.errors.name || xhr.responseJSON.errors.lname || xhr.responseJSON.errors.cellphone ||
                                            xhr.responseJSON.errors.is_admin,

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

            $('#createUserButton').on('click', function (e) {
                e.preventDefault();
                let thisElement = $(this);
                let name = $("#createUserName");
                let lname = $("#createUserlName");
                let cellphone = $("#createUserCellphone");

                let role = $("#createUserRole");

                showProgressButton(thisElement);
                $.ajax({
                        url: `/admin/users`,
                        type: 'POST',
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {
                            "name": name.val(),
                            "lname": lname.val(),
                            "cellphone": cellphone.val(),
                            "is_admin": role.val()
                        },
                        success: function (response) {
                            Swal.fire(
                                {
                                    type: 'success',
                                    text: 'کاربر با موفقیت اضافه شد!',
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
                                        text: xhr.responseJSON.errors.name || xhr.responseJSON.errors.lname || xhr.responseJSON.errors.cellphone ||
                                            xhr.responseJSON.errors.is_admin,

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

            $('.delete_user').on('click', function () {
                let thisElement = $(this);
                Swal.fire(
                    {
                        title: 'حذف کاربر',
                        type: 'warning',
                        text: 'آیا از حذف کاربر مطمین هستید؟',
                        confirmButtonText: 'تایید',
                        cancelButtonText: 'لغو',
                        showCancelButton: true,
                        closeOnConfirm: false,
                        closeOnCancel: true
                    }).then(function (result) {
                    console.log(result.isConfirmed)
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/users/${thisElement.data('id')}`,
                            type: 'DELETE',
                            dataType: 'JSON',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                Swal.fire(
                                    {
                                        type: 'success',
                                        text: 'کاربر با موفقیت حذف شد!',
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
                                            text: 'کاربر مورد نظر یافت نشد!',
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
    <script>
        doEdit = function (a, u) {
            $.ajaxSetup({'headers': {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});
            $.ajax({
                url: '{{ url('admin/users/account_number/doEdit') }}',
                type: 'POST',
                data: 'a=' + a + '&u=' + u,
                success: function (data) {
                    console.log(data);
                   if (data==1){
                       Swal.fire({
                           type: 'success',
                           icon: 'success',
                           html: a === 1 ? 'اجازه ویرایش داده شد.' : 'اجازه ویرایش <b>حذف</b> شد.',
                           showConfirmButton: false,
                           timer: 1500
                       });
                       setTimeout(() => {
                           window.location.reload();
                       }, 1500)
                   }else
                       Swal.fire({
                           title: 'خطا',
                           type: 'error',
                           icon: 'warning',
                           text: 'خطای داده ای ',
                           showConfirmButton: false,
                           timer: 1500
                       });
                }, error: function (xhr, status, error) {
                    if (xhr.status === 422) {
                        Swal.fire({
                            title: 'خطا',
                            type: 'error',
                            text: xhr.responseJSON.errors.name || xhr.responseJSON.errors.lname || xhr.responseJSON.errors.cellphone,
                            confirmButtonText: 'باشه'
                        });
                    } else {
                        Swal.fire({
                            title: 'خطا',
                            type: 'error',
                            text: xhr.responseJSON.error || 'خطای سرور ',
                            confirmButtonText: 'باشه'
                        });
                    }
                }
            });
        }
    </script>
@endsection