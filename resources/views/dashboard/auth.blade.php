@extends('dashboard._html')

@section('head-links')
    @parent
    <script src="https://www.google.com/recaptcha/api.js?render=6LdhAgQqAAAAADNEV3QhCbeoJA7Ml2y8SK58bMDP"></script>

@endsection

@section('content')
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style> body {
                background-image: url('{{asset('assets/media/auth/bg4.jpg')}}');
            }

            [data-bs-theme="dark"] body {
                background-image: url('{{asset('assets/media/auth/bg4-dark.jpg')}}');
            }</style>
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
            <div
                    class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
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
                                <input id="cellphone" type="text" placeholder="شماره تلفن (09123332211)"
                                       name="cellphone" autocomplete="off" class="form-control bg-transparent"/>
                                <!--end::Email-->
                            </div>
                            <!--end::Input group=-->
                            <div class="fv-row mb-3">
                                <input style="display: none;" type="number" maxlength="6" id="otp_code"
                                       placeholder="کد تایید ارسال شده"
                                       name="code" autocomplete="off" class="form-control bg-transparent"/>
                            </div>
                            <div class="fv-row mb-3">
                                <input style="display: none;" type="text" id="name"
                                       placeholder="نام"
                                       name="name" autocomplete="off" class="form-control bg-transparent"/>
                            </div>
                            {{--<div class="fv-row mb-3">
                                <input style="display: none;" type="email" id="email"
                                       placeholder="ایمیل"
                                       name="email" autocomplete="off" class="form-control bg-transparent"/>
                            </div>--}}
                            <div style="justify-content: space-between"
                                 class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <p style="display: none;" id="timer_text" class="text-info"></p>
                                <a style="display: none;" id="edit_number" href="#">ویرایش شماره</a>
                            </div>
                            {!!  GoogleReCaptchaV3::renderField('otp_form_id','otp_action') !!}
                            <!--end::Wrapper-->
                            <!--begin::ارسال button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_request" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">ارسال کد</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">در حال ارسال ...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                                <button style="display: none" type="submit" id="kt_sign_in_submit"
                                        class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">ورود</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">در حال ارسال ...
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
        let files_list = []
        $(document).ready(function () {

            function timer(expire_time) {
                const interval = setInterval(function () {
                    if (expire_time <= 0) {
                        $('#timer_text').html('00:00');
                        clearInterval(interval);
                        $('#cellphone').css('display', 'block');
                        $('#otp_code').css('display', 'none');
                        $('#email').css('display', 'none');
                        $('#name').css('display', 'none');
                        $('#timer_text').css('display', 'none');
                        $('#edit_number').css('display', 'none');
                        $('#kt_sign_in_request').css('display', 'block');
                        $('#kt_sign_in_submit').css('display', 'none');
                        $("#request_errors").html('');

                        return;
                    }

                    const minutes = Math.floor(expire_time / 60);
                    const seconds = expire_time % 60;

                    function str_pad_left(string, pad, length) {
                        return (new Array(length + 1).join(pad) + string).slice(-length);
                    }

                    const finalTime = str_pad_left(minutes, '0', 2) + ':' + str_pad_left(seconds, '0', 2);
                    $('#timer_text').html(finalTime);

                    expire_time--;
                }, 1000);
            }


            $("#edit_number").click(function (e) {
                e.preventDefault();
                $('#cellphone').css('display', 'block');
                $('#otp_code').css('display', 'none');
                $('#email').css('display', 'none');
                $('#name').css('display', 'none');
                $('#timer_text').css('display', 'none');
                $('#edit_number').css('display', 'none');
                $('#kt_sign_in_request').css('display', 'block');
                $('#kt_sign_in_submit').css('display', 'none');
                $("#request_errors").html('');

            });

            $("#kt_sign_in_request").click(function (e) {
                e.preventDefault();
                showProgressButton($(this));
                const this_button = $(this);

                if ($("#cellphone").val() !== '') {
                    $("#request_errors").html('');
                    const data = {
                        cellphone: $('#cellphone').val(),
                        _token: `{{ csrf_token() }}`,
                        'g-recaptcha-response': getReCaptchaV3Response('otp_form_id')
                    }

                    $.ajax({
                        url: '/auth/otp/request',
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(data),
                        success: function (response) {
                            hideProgressButton(this_button);
                            refreshReCaptchaV3('otp_form_id', 'otp_action');

                            $('#cellphone').css('display', 'none');
                            $('#otp_code').css('display', 'block');

                            if (response.is_new) {
                                $('#name').css('display', 'block');
                                $('#email').css('display', 'block');
                            }

                            $('#timer_text').css('display', 'block');
                            $('#edit_number').css('display', 'block');
                            $('#kt_sign_in_request').css('display', 'none');
                            $('#kt_sign_in_submit').css('display', 'block');
                            $("#request_errors").html('');

                            timer(response.expires_after);
                        },
                        error: function (xhr) {
                            hideProgressButton(this_button);
                            refreshReCaptchaV3('otp_form_id', 'otp_action');

                            $("#request_errors").html(xhr.responseJSON.message);
                            if (xhr.responseJSON.errors) {
                                $("#request_errors").html(xhr.responseJSON.errors.cellphone[0]);
                            }
                        }
                    });
                } else {
                    $("#request_errors").html('شماره تلفن را وارد کنید!');
                }
            });

            $('#cellphone').keypress(function (e) {
                let key = e.which;
                if (key === 13)  // the enter key code
                {
                    $('#kt_sign_in_request').click();
                    return false;
                }
            });

            $('#otp_code').keypress(function (e) {
                let key = e.which;
                if (key === 13)  // the enter key code
                {
                    $('#kt_sign_in_submit').click();
                    return false;
                }
            });

            $('#name').keypress(function (e) {
                let key = e.which;
                if (key === 13)  // the enter key code
                {
                    $('#kt_sign_in_submit').click();
                    return false;
                }
            });

            $('#email').keypress(function (e) {
                let key = e.which;
                if (key === 13)  // the enter key code
                {
                    $('#kt_sign_in_submit').click();
                    return false;
                }
            });

            $("#kt_sign_in_submit").click(function (e) {
                e.preventDefault();
                showProgressButton($(this));
                const this_button = $(this);
                if ($("#cellphone").val() !== '' || $("otp_code").val() !== '') {
                    $("#request_errors").html('');
                    const data = {
                        cellphone: $('#cellphone').val(),
                        otp: $("#otp_code").val(),
                        name: $("#name").val(),
                        email: $("#email").val(),
                        _token: `{{ csrf_token() }}`,
                        'g-recaptcha-response': getReCaptchaV3Response('otp_form_id')
                    }

                    $.ajax({
                        url: '/auth/otp/submit',
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(data),
                        success: function (response) {
                            hideProgressButton(this_button);
                            refreshReCaptchaV3('otp_form_id', 'otp_action');

                            // if(response.user?.is_admin){
                            //     window.location= '/admin/transactions';
                            // }else {
                            window.location = '/account_number';
                            // }
                        },
                        error: function (xhr) {
                            hideProgressButton(this_button);
                            refreshReCaptchaV3('otp_form_id', 'otp_action');
                            $("#request_errors").html(xhr.responseJSON.message);
                            if (xhr.responseJSON.errors) {
                                $("#request_errors").html(xhr.responseJSON.errors?.otp[0] || xhr.responseJSON.errors?.name[0] || xhr.responseJSON.errors?.email[0]);
                            }
                        }
                    });
                } else {
                    $("#request_errors").html('شماره تلفن را وارد کنید!');
                }
            });
        });
    </script>
    {!!  GoogleReCaptchaV3::init() !!}

@endsection


