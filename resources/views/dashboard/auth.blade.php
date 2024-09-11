@extends('dashboard._html')

@section('content')
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style> body {
                background-image: url('{{asset('assets/media/auth/bg4.jpg')}}');
            }

            [data-bs-theme="dark"] body {
                background-image: url('{{asset('assets/media/auth/bg4-dark.jpg')}}');
            }
        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - ورود -->
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <!--begin::Aside-->
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <!--begin::Aside-->
                <div class="d-flex flex-center flex-column text-center">
                    <!--begin::Logo-->
                    <a href="#" class="mb-7">
                        <img alt="Logo" style="width:50%" src="{{asset('assets/media/logo.png')}}"/>
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h2 class="text-white fw-normal m-0 text-center"> گروه خودروسازی سایپا </h2>
                    <!--end::Title-->
                </div>
                <!--begin::Aside-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <!--begin::Card-->
                <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="#"
                              action="#">
                            @csrf()
                            <div class="separator separator-content my-20">
                            </div>
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">ورود</h1>
                            </div>
                            <!--end::Separator-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input id="cellphone" type="text" placeholder="شماره موبایل"
                                       name="cellphone" autocomplete="off" class="form-control bg-transparent"/>
                                <!--end::Email-->
                            </div>
                            <div class="fv-row mb-8">
                                <!--begin::Password-->
                                <input id="password" type="password" placeholder="کلمه عبور"
                                       name="password" autocomplete="off" class="form-control bg-transparent"/>
                                <!--end::Password-->
                            </div>
                            <!--end::Input group=-->
                            {{--{!!  GoogleReCaptchaV3::renderField('otp_form_id','otp_action') !!}--}}
                            <!--end::Wrapper-->
                            <!--begin::ارسال button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_request" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">ورود </span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">در حال بررسی ...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                            <p id="request_errors" class="text-danger"></p>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Footer-->
                    <div class="d-flex flex-stack px-lg-10">
                        <div class="d-flex fw-semibold text-primary fs-base gap-5">
                            {{--                            <a href="#" target="_blank">خانه</a>--}}
                            {{--                            <a href="#" target="_blank">فراخوان ها</a>--}}
                            {{--                            <a href="#" target="_blank">خبر ها</a>--}}
                        </div>
                        <!--end::Links-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - ورود-->
    </div>
    <!--end::Root-->
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $("#kt_sign_in_request").click(function (e) {
                e.preventDefault();
                showProgressButton($(this));
                const this_button = $(this);

                if ($("#cellphone").val() !== '') {
                    $("#request_errors").html('');
                    const data = {
                        cellphone: $('#cellphone').val(),
                        password: $('#password').val(),
                        _token: `{{ csrf_token() }}`,
                        // 'g-recaptcha-response': getReCaptchaV3Response('otp_form_id')
                    }

                    $.ajax({
                        url: '/auth/login',
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(data),
                        success: function (response) {
                            hideProgressButton(this_button);
                            //refreshReCaptchaV3('otp_form_id', 'otp_action');
                            $("#request_errors").html('');
                            window.location = '/user/food';
                        },
                        error: function (xhr) {
                            hideProgressButton(this_button);
                           // refreshReCaptchaV3('otp_form_id', 'otp_action');

                            $("#request_errors").html(xhr.responseJSON.message);
                            if (xhr.responseJSON.errors) {
                                $("#request_errors").html(xhr.responseJSON.errors.email[0] || xhr.responseJSON.errors.password[0]);
                            }
                        }
                    });
                } else {
                    $("#request_errors").html('نام کاربری و رمز عبور را وارد کنید!');
                }
            });

            $('#password').keypress(function (e) {
                let key = e.which;
                if (key == 13)  // the enter key code
                {
                    $('#kt_sign_in_request').click();
                    return false;
                }
            });
        });
    </script>
@endsection