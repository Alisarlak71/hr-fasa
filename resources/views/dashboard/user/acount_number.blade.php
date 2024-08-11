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
                    <li class="breadcrumb-item text-muted">حساب بانکی</li>
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
    <style>
        .has-error {
            color: red;
        }

        input {
            text-align: center;
            direction: ltr;
        }
    </style>
    <form id="add_account" class="form mt-6" onsubmit="add_account();return false;"
          action="{{ url('account_number') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="canEdit" value="{{ $old->edit??0 }}">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <h3>مشخصات حساب حقوق</h3>
                <div class="card mb-5 mb-xl-10 px-3 py-2">
                    <div class="d-flex gap-2 ">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" style="width: 150px">شماره شبا
                            حقوق</label>
                        <div>
                            <div class="d-flex align-items-center">
                                <input class="form-control numeric" type="text"
                                       style="min-width: 200px; max-width: 400px"
                                       placeholder="شماره شبا حقوق" name="h_sheba" id="h_sheba"
                                       value="{{ $old->h_sheba??'' }}">
                                IR
                            </div>
                            <span id="error_h_sheba" class="has-error"></span>
                        </div>
                    </div>
                    <div class="d-flex gap-2 ">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" style="width: 150px">شماره حساب
                            حقوق</label>
                        <div>
                            <input class="form-control numeric" type="text" style="min-width: 200px; max-width: 400px"
                                   placeholder="شماره حساب حقوق" name="h_hesab" id="h_hesab"
                                   value="{{ $old->h_hesab??'' }}">
                            <span id="error_h_hesab" class="has-error"></span>
                        </div>
                    </div>
                    <div class="d-flex gap-2 ">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" style="width: 150px">شماره کارت
                            حقوق</label>
                        <div>
                            <input class="form-control numeric" type="text" style="min-width: 200px; max-width: 400px"
                                   placeholder="شماره کارت حقوق" name="h_cart" id="h_cart"
                                   value="{{ $old->h_cart??'' }}">
                            <span id="error_h_cart" class="has-error"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content_container" class="app-container container-fluid">
                <h3>مشخصات حساب بن کارت</h3>
                <div class="card mb-5 mb-xl-10 px-3 py-2">
                    <div class="d-flex gap-2 ">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" style="width: 150px">شماره شبا
                            بن کارت</label>
                        <div>
                            <div class="d-flex align-items-center">
                                <input class="form-control numeric" type="text"
                                       style="min-width: 200px; max-width: 400px"
                                       placeholder="شماره شبا بن کارت" name="b_sheba" id="b_sheba"
                                       value="{{ $old->b_sheba??'' }}">
                                IR
                            </div>
                            <span id="error_b_sheba" class="has-error"></span>
                        </div>
                    </div>
                    <div class="d-flex gap-2 ">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" style="width: 150px">شماره حساب
                            بن کارت</label>
                        <div>
                            <input class="form-control numeric" type="text" style="min-width: 200px; max-width: 400px"
                                   placeholder="شماره حساب بن کارت" name="b_hesab" id="b_hesab"
                                   value="{{ $old->b_hesab??'' }}">
                            <span id="error_b_hesab" class="has-error"></span>
                        </div>
                    </div>
                    <div class="d-flex gap-2 ">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6" style="width: 150px">شماره کارت
                            بن کارت</label>
                        <div>
                            <input class="form-control numeric" type="text" style="min-width: 200px; max-width: 400px"
                                   placeholder="شماره کارت بن کارت" name="b_cart" id="b_cart"
                                   value="{{ $old->b_cart??'' }}">
                            <span id="error_b_cart" class="has-error"></span>
                        </div>
                    </div>
                </div>
                <div id="btnSub">
                    @if($canAdd==1 || $old->edit==1)
                        <button id="confirmOtp" type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                            <span class="indicator-label">ذخیره و ارسال</span>
                            <span class="indicator-progress">لطفا صبر کنید...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                        </button>
                    @else
                        <div style="color: darkgreen; font-size: 18px">
                            مشخصات حساب شما ثبت شده است.
                        </div>
                    @endif
                </div>
            </div>
            <!--end::Content container-->
        </div>
    </form>
    <!--end::Content-->

    @if($canAdd==0 && $old->edit==0)
        <script>
            $('input[type="text"]').prop('readonly', true);
        </script>
    @endif
    <script>
        $(document).on("input", ".numeric", function () {
            this.value = this.value.replace(/(?!-)[^0-9.]/g, '');
        });
        add_account = function () {
            Swal.fire({
                title: "آیا از ثبت و ارسال فرم اطمینان دارید؟",
                icon: "info",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "بله",
                denyButtonText: `خیر`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajaxSetup({'headers': {'X-CSRF-TOKEN': "{{csrf_token()}}"}});
                    let data = $("#add_account").serialize();
                    $.ajax({
                        url: '/add_account',
                        type: 'POST',
                        data: 'data=' + data,
                        success: function (data) {
                            //console.log(data);
                            if (data == 'ok') {
                                Swal.fire({
                                    type: 'success',
                                    icon: "success",
                                    text: 'اطلاعات حساب با موفقیت ثبت شد.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#btnSub').empty();
                                $('input[type="text"]').prop('readonly', true);
                            } else if (data == 'error') {
                                Swal.fire({
                                    type: 'warning',
                                    icon: "warning",
                                    text: 'خطا در ثبت اطلاعات، مجددا تلاش کنید',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                let d = $.parseJSON(data);
                                let string = 'h_sheba|h_hesab|h_cart|b_sheba|b_hesab|b_cart';
                                let e = string.split('|');
                                for (let i = 0; i < e.length; i++)
                                    $("#error_" + e[i]).html("");
                                $.each(d, function (key, value) {
                                    $("#error_" + key).html(value);
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                title: 'خطا',
                                icon: "error",
                                type: 'error',
                                text: 'خطا',
                                confirmButtonText: 'باشه'
                            });
                        },
                    });
                } else if (result.isDenied) {
                    Swal.fire({
                        type: 'success',
                        text: 'موارد وارد شده را بررسی و سپس ارسال فرمایید.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    </script>
@endsection
