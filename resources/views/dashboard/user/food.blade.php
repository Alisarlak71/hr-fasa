@extends('dashboard.user._layout')

@section('title', $title)

@section('main')
    <style>
        .mmz.wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .mmz .button {
            min-width: 300px;
            min-height: 60px;
            display: inline-flex;
            font-family: 'Nunito', sans-serif;
            font-size: 22px;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            text-align: center;
            letter-spacing: 1.3px;
            font-weight: 700;
            color: #313133;
            background: #e78e22;
            background: linear-gradient(90deg, #ea9a3a 0%, #e78e22 100%);
            border: none;
            border-radius: 1000px;
            box-shadow: 12px 12px 24px #e69c41;
            transition: all 0.3s ease-in-out 0s;
            cursor: pointer;
            outline: none;
            position: relative;
            padding: 10px;
        }

        .mmz .button::before {
            content: '';
            border-radius: 1000px;
            min-width: calc(300px + 12px);
            min-height: calc(60px + 12px);
            border: 6px solid #f19f3f;
            box-shadow: 0 0 60px #d8821a;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: all .3s ease-in-out 0s;
        }

        .mmz .button:hover,
        .mmz .button:focus {
            color: #313133;
            transform: translateY(-6px);
        }

        .mmz .button:hover::before,
        .mmz .button:focus::before {
            opacity: 1;
        }

        .mmz .button::after {
            content: '';
            width: 30px;
            height: 30px;
            border-radius: 100%;
            border: 6px solid #d6913d;
            position: absolute;
            z-index: -1;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: ring 1.5s infinite;
        }

        .mmz .button:hover::after,
        .mmz .button:focus::after {
            animation: none;
            display: none;
        }

        @keyframes ring {
            0% {
                width: 10px;
                height: 10px;
                opacity: 0.8;
            }
            50% {
                width: 135px;
                height: 135px;
                opacity: 0.3;
            }
            100% {
                width: 280px;
                height: 280px;
                opacity: 0;
            }
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
                    <h2 class="fs-2x fw-bold mb-10">وضعیت حضور</h2>
                    <div>{{ \Morilog\Jalali\CalendarUtils::strftime('%A d/F/Y',time()) }}</div>
                </div>
                <!--end::Wrapper-->
            </div>
            @if(\App\Models\food::where('user_id',auth()->id())->whereDate('created_at', \Illuminate\Support\Carbon::today())->first())
                <div class="d-block text-center fs-3" style="color: #00b300">وضعیت شما ثبت شده است</div>
            @else
                <div style="height: 300px">
                    <div class="mmz wrap">
                        <button class="button text-white" onclick="accept()">امروز حضور دارم</button>
                    </div>
                    <span class="indicator-progress" style="text-align: center; z-index: 99; margin-top: 1em">
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    لطفا صبر کنید
                </span>
                </div>
            @endif
        </div>
    </div>
    <script>
        accept = function () {
            $.ajaxSetup({'headers': {'X-CSRF-TOKEN': "{{csrf_token()}}"}});
            let data = $("#add_account").serialize();
            $('.indicator-progress').show();
            $.ajax({
                url: '/user/food',
                type: 'POST',
                data: 'data=' + data,
                success: function (data) {
                    $('.indicator-progress').hide();
                    if (data == 'ok') {
                        Swal.fire({
                            title: 'حضور شما',
                            icon: "success",
                            type: 'success',
                            text: 'به درستی ثبت شد',
                            confirmButtonText: 'باشه'
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000)
                    } else
                        Swal.fire({
                            title: 'خطا',
                            icon: "error",
                            type: 'error',
                            text: 'لطفا مجدد امتحان کنید',
                            confirmButtonText: 'باشه'
                        });
                },
                error: function (xhr, status, error) {
                    $('.indicator-progress').hide();
                    Swal.fire({
                        title: 'خطا',
                        icon: "error",
                        type: 'error',
                        text: 'خطا',
                        confirmButtonText: 'باشه'
                    });
                },
            });
        }
    </script>
@endsection