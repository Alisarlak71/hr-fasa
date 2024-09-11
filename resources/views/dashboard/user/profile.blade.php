@extends('dashboard.user._layout')

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
                    کاربر</h1>
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
                    <li class="breadcrumb-item text-muted">پروفایل</li>
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
                            <span class="card-label fw-bold fs-3 mb-1">پروفایل</span>
                            <span class="text-muted mt-1 fw-semibold fs-7"></span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-9 pb-0">
                        <!--begin::Details---->
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <!--begin: Pic-->
                            <div class="me-7 mb-4">
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{$user->photo->download_link??asset('assets/media/avatars/blank.png')}}')">
                                    <!--begin::نمایش existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{$user->photo->download_link??asset('assets/media/avatars/blank.png')}}')"></div>
                                    <!--end::نمایش existing avatar-->
                                    <!--begin::Tags-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="تعویض آواتار">
                                        <i class="ki-duotone ki-pencil fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <!--begin::Inputs-->
                                        <input id="change_avatar" type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Tags-->
                                    <!--begin::انصراف-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="انصراف avatar">
																	<i class="ki-duotone ki-cross fs-2">
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</span>
                                    <!--end::انصراف-->
                                    <!--begin::حذف-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف آواتار">
																	<i class="ki-duotone ki-cross fs-2">
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</span>
                                    <!--end::حذف-->
                                </div>
                                <!--end::Image input-->
{{--                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">--}}
{{--                                    <img src="{{asset('assets/media/avatars/blank.png')}}" alt="image"/>--}}
{{--                                    <div--}}
{{--                                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>--}}
{{--                                </div>--}}
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::user-->
                                    <div class="d-flex flex-column">
                                        <!--begin::نام-->
                                        <div class="d-flex align-items-center mb-2">
                                            <a href="#"
                                               class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{$user->name}}</a>
                                            <a href="#">
                                                <i class="ki-duotone ki-verify fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                        </div>
                                        <!--end::نام-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">

                                            <a href="#"
                                               class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                                <i class="ki-duotone ki-geolocation fs-4 me-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>{{$user->cellphone}}</a>
                                            <a href="#"
                                               class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                                <i class="ki-duotone ki-sms fs-4">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>{{$user->email}}</a>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::user-->
                                </div>
                                <!--end::Title-->
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap flex-stack">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                        <!--begin::Stats-->
                                        {{--<div class="d-flex flex-wrap">
                                            <!--begin::Stat-->
                                            <div
                                                class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <!--begin::شماره کارت-->
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    <div class="fs-2 fw-bold" data-kt-countup="true"
                                                         data-kt-countup-value="{{0}}"
                                                         data-kt-countup-prefix="">0
                                                    </div>
                                                </div>
                                                <!--end::شماره کارت-->
                                                <!--begin::Tags-->
                                                <div class="fw-semibold fs-6 text-gray-400">فایل های موفق</div>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::Stat-->
                                            <!--begin::Stat-->
                                            <div
                                                class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <!--begin::شماره کارت-->
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-arrow-down fs-3 text-danger me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    <div class="fs-2 fw-bold" data-kt-countup="true"
                                                         data-kt-countup-value="{{0}}"
                                                         data-kt-countup-prefix="">0
                                                    </div>
                                                </div>
                                                <!--end::شماره کارت-->
                                                <!--begin::Tags-->
                                                <div class="fw-semibold fs-6 text-gray-400">فایل های ناموفق</div>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::Stat-->

                                        </div>--}}
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details---->
                        <!--begin::Navs-->
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="#">تنظیمات</a>
                            </li>
                        </ul>
                        <!--begin::Navs-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
            <div class="card mb-5 mb-xl-10">
                <!--begin::کارت header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                     data-bs-target="#kt_account_profile_details" aria-expanded="true"
                     aria-controls="kt_account_profile_details">
                    <!--begin::کارت title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0"> تنظیمات پروفایل</h3>
                    </div>
                    <!--end::کارت title-->
                </div>
                <!--begin::کارت header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" class="form">
                        <!--begin::کارت body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Tags-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">نام کامل</label>
                                <!--end::Tags-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" name="name" id="userName"
                                                   class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                   placeholder="نام" value="{{$user->name}} {{$user->lname}}"/>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Tags-->
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">تلفن</span>
                                </label>
                                <!--end::Tags-->
                                <!--begin::Col-->
                                <div class="col-lg-6 fv-row">
                                    <input type="tel" id="userCellphone" name="phone" value="{{$user->cellphone}}"
                                           class="form-control form-control-lg form-control-solid"
                                           placeholder="09......."/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            {{--<div class="row mb-6">
                                <!--begin::Tags-->
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">ایمیل</span>
                                </label>
                                <!--end::Tags-->
                                <!--begin::Col-->
                                <div class="col-lg-6 fv-row">
                                    <input type="tel" id="userEmail" name="email" value="{{$user->email}}"
                                           class="form-control form-control-lg form-control-solid"
                                           placeholder="example@email.com"/>
                                </div>
                                <!--end::Col-->
                            </div>--}}
                            <!--end::Input group-->
                        </div>
                        <!--end::کارت body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button id="submitUpdateUser" type="button" class="btn btn-lg btn-primary"
                                    data-kt-element="details-next">
                                <span class="indicator-label">ثبت تغییرات</span>
                                <span class="indicator-progress">لطفا صبر کنید...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
        </div>
        <!--end::Content container-->
        <div class="app-container container-fluid">
            <div class="card mb-5 mb-xl-10" id="user_password_section">
                <!--begin::کارت header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                     data-bs-target="#kt_account_profile_details" aria-expanded="true"
                     aria-controls="kt_account_profile_details">
                    <!--begin::کارت title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0"> تغییر کلمه عبور </h3>
                    </div>
                    <!--end::کارت title-->
                </div>
                <!--begin::کارت header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_password_form" class="form">
                        <!--begin::کارت body-->
                        <div class="card-body border-top p-9">
                            <div class="row col-8 gx-10 mb-5">
                                <div class="col-lg-6 mt-7">
                                    <!--begin::Tags-->
                                    <label class="fs-6 fw-semibold form-label mb-2">کلمه عبور فعلی</label>
                                    <!--end::Tags-->
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative">
                                        <!--begin::Input-->
                                        <input autocomplete="off" type="password"
                                               class="form-control form-control-solid"
                                               placeholder="کلمه عبور فعلی" name="userCurrentPassword"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input wrapper-->
                                </div>
                            </div>
                            <div class="row col-8 gx-10 mb-5">
                                <div class="col-lg-6 mt-7">
                                    <!--begin::Tags-->
                                    <label class="fs-6 fw-semibold form-label mb-2">کلمه عبور جدید</label>
                                    <!--end::Tags-->
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative">
                                        <!--begin::Input-->
                                        <input autocomplete="off" type="password"
                                               class="form-control form-control-solid"
                                               placeholder="کلمه عبور " name="userPassword"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input wrapper-->
                                </div>
                            </div>
                            <div class="row col-8 gx-10 mb-5">
                                <div class="col-lg-6 mt-7">
                                    <!--begin::Tags-->
                                    <label class="fs-6 fw-semibold form-label mb-2">تکرار کلمه عبور</label>
                                    <!--end::Tags-->
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative">
                                        <!--begin::Input-->
                                        <input autocomplete="off" type="password"
                                               class="form-control form-control-solid"
                                               placeholder="کلمه عبور " name="userPasswordConfirm"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input wrapper-->
                                </div>
                            </div>
                        </div>
                        <!--end::کارت body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button id="submitUpdatePasswordUser" type="button" class="btn btn-lg btn-primary"
                                    data-kt-element="details-next">
                                <span class="indicator-label">ثبت رمز عبور دید</span>
                                <span class="indicator-progress">لطفا صبر کنید...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
        </div>
    </div>
    <!--end::Content-->
    <!--begin::Modal body-->
    <div id="confirmOtpModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>کد تایید</h2>
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
                        {{--<div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Tags-->
                            <label class="fs-6 fw-semibold form-label mb-2">کد تایید پیامک شده</label>
                            <!--end::Tags-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <!--begin::Input-->
                                <input type="text" id="otpCode" class="form-control form-control-solid"
                                       placeholder="کد تایید" name="code"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input wrapper-->
                        </div>--}}
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">لغو</button>
                            <button id="confirmOtp" type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
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
                $("#submitUpdateUser").click(function () {
                    let submitUpdateUserElement = $(this);
                    showProgressButton($(submitUpdateUserElement));
                    let name = $("#userName");
                    let email = $("#userEmail");
                    let cellphone = $("#userCellphone");
                    if (name.val() !== "" && email.val() !== "" && cellphone.val() !== ""
                    ) {
                        $.ajax({
                            url: '/profile',
                            type: 'PUT',
                            dataType: 'JSON',
                            data: {
                                "_token": "{{csrf_token()}}",
                                "name": name.val(),
                                "email": email.val(),
                                "cellphone": cellphone.val()
                            },
                            success: function (response) {
                                if (response.expires_after) {
                                    console.log(response.expires_after);
                                    $('#confirmOtpModal').modal('show');
                                } else {
                                    Swal.fire(
                                        {
                                            type: 'success',
                                            text: 'درخواست با موفقیت ثبت شد',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    setTimeout(()=>{window.location.reload();},2000)
                                }

                                hideProgressButton(submitUpdateUserElement);
                                //
                            },
                            error: function (xhr, status, error) {
                                hideProgressButton(submitUpdateUserElement);
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
                        });

                    } else {

                        Swal.fire(
                            {
                                title: 'خطا',
                                type: 'error',
                                text: 'تمام فیلد ها رو پر کنید',
                                confirmButtonText: 'باشه'
                            });
                        hideProgressButton(submitUpdateUserElement);
                    }
                });
            });

            $("#confirmOtp").click(function (e) {
                e.preventDefault();
                let submitUpdateUserElement = $(this);
                showProgressButton($(submitUpdateUserElement));
                let name = $("#userName");
                let email = $("#userEmail");
                let cellphone = $("#userCellphone");
                let otp = $("#otpCode");
                if (name.val() !== "" && email.val() !== "" && cellphone.val() !== "" && otp.val() !== ""
                ) {
                    $.ajax({
                        url: '/profile/submit',
                        type: 'PUT',
                        dataType: 'JSON',
                        data: {
                            "_token": "{{csrf_token()}}",
                            "name": name.val(),
                            "email": email.val(),
                            "cellphone": cellphone.val(),
                            "otp": otp.val()
                        },
                        success: function (response) {
                            Swal.fire(
                                {
                                    type: 'success',
                                    text: 'درخواست با موفقیت ثبت شد',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            $("#confirmOtpModal").modal("hide");
                            setTimeout(()=>{window.location.reload();},2000)

                            hideProgressButton(submitUpdateUserElement);
                        },
                        error: function (xhr, status, error) {
                            hideProgressButton(submitUpdateUserElement);
                            if (xhr.status === 422) {
                                Swal.fire(
                                    {
                                        title: 'خطا',
                                        type: 'error',
                                        text: xhr.responseJSON.errors.error||xhr.responseJSON.errors.name || xhr.responseJSON.errors.cellphone || xhr.responseJSON.errors.email|| xhr.responseJSON.errors.otp,
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

                } else {

                    Swal.fire(
                        {
                            title: 'خطا',
                            type: 'error',
                            text: 'تمام فیلد ها رو پر کنید',
                            confirmButtonText: 'باشه'
                        });
                    hideProgressButton(submitUpdateUserElement);
                }
                });
            $("#change_avatar").change(function(e){
                let formData = new FormData();
                let file = $("#change_avatar")[0].files[0];
                formData.append('file', file);
                formData.append('_token', "{{ csrf_token() }}");
                Swal.showLoading();
                $.ajax({
                    url: '/profile/change_photo',
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
                        window.location.reload();
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

            $("#submitUpdatePasswordUser").on('click', function () {
                let submitUpdateUserElement = $(this);
                showProgressButton($(submitUpdateUserElement));
                let password = $('input[name="userPassword"]');
                let confirm_password = $('input[name="userPasswordConfirm"]');
                let current_password = $('input[name="userCurrentPassword"]');
                if (password.val() !== "" && confirm_password.val() !== "" && current_password.val() !== ""
                ) {
                    $.ajax({
                        url: '/profile/change-password',
                        type: 'PUT',
                        dataType: 'JSON',
                        data: {
                            "_token": "{{csrf_token()}}",
                            "password": password.val(),
                            "current_password": current_password.val(),
                            "password_confirmation": confirm_password.val()
                        },
                        success: function (response) {
                            Swal.fire(
                                {
                                    type: 'success',
                                    text: 'درخواست با موفقیت ثبت شد',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000)

                            hideProgressButton(submitUpdateUserElement);
                        },
                        error: function (xhr, status, error) {
                            hideProgressButton(submitUpdateUserElement);
                            if (xhr.status === 422) {
                                Swal.fire(
                                    {
                                        title: 'خطا',
                                        type: 'error',
                                        text: xhr.responseJSON.errors.password || xhr.responseJSON.errors.current_password,
                                        confirmButtonText: 'باشه'
                                    });
                            } else {
                                Swal.fire(
                                    {
                                        title: 'رمز عبور فعلی نادرست است',
                                        type: 'error',
                                        text: xhr.responseJSON.error || 'خطای اطلاعات ',
                                        confirmButtonText: 'باشه'
                                    });
                            }
                        }
                    });

                } else {
                    Swal.fire(
                        {
                            title: 'خطا',
                            type: 'error',
                            text: 'رمز عبور فعلی و جدید را پر کنید',
                            confirmButtonText: 'باشه'
                        });
                    hideProgressButton(submitUpdateUserElement);
                }
            });
        </script>
@endsection
