@extends('dashboard._html')

@section('head-links')
    @parent

@endsection

@section('content')
    @include('dashboard.user.__header')
    <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
        @include('dashboard.user.__sidebar')

        <!--begin::اصلی-->
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <!--begin::Content wrapper-->
            <div class="d-flex flex-column flex-column-fluid">
                @yield('main')
            </div>
            <!--end::Content wrapper-->
            <!--begin::Footer-->
            <div id="kt_app_footer" class="app-footer">
                <!--begin::Footer container-->
                <div
                        class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                    <!--begin::کپیright-->
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-semibold me-1">2023&copy;</span>
                        <a href="https://fasatech.ir/" target="_blank" class="text-gray-800 text-hover-primary">فناوری
                            سایپا ارتباط</a>
                    </div>
                    <!--end::کپیright-->
                    <!--begin::Menu-->
                    <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                        <li class="menu-item">
                            <a href="#" target="_blank" class="menu-link px-2">درباره ی ما</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" target="_blank" class="menu-link px-2">پشتیبانی</a>
                        </li>
                    </ul>
                    <!--end::Menu-->
                </div>
                <!--end::Footer container-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end:::اصلی-->
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(".kt_add_to_card_request").on('click', function () {
                let submitUpdateUserElement = $(this);
                showProgressButton($(submitUpdateUserElement));
                let id = $(this).attr('data-id');
                let type = $(this).attr('data-type');
                $.ajax({
                    url: '/card/add',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        "_token": "{{csrf_token()}}",
                        "id": id,
                        "count": 1,
                        "type": type,
                    },
                    success: function (response) {
                        Swal.fire(
                            {
                                type: 'success',
                                text: 'محصول با موفقیت به سبد خرید اضافه شد!',
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
                                    text: xhr.responseJSON.errors.id || xhr.responseJSON.errors.type || xhr.responseJSON.errors.count,
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
            $(".kt_remove_from_card_request").on('click', function () {
                let submitUpdateUserElement = $(this);
                showProgressButton($(submitUpdateUserElement));
                let id = $(this).attr('data-id');
                let type = $(this).attr('data-type');
                $.ajax({
                    url: '/card/remove',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        "_token": "{{csrf_token()}}",
                        "id": id,
                        "count": 1,
                        "type": type,
                    },
                    success: function (response) {
                        Swal.fire(
                            {
                                type: 'success',
                                text: 'محصول با موفقیت از سبد خرید حذف شد!',
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
                                    text: xhr.responseJSON.errors.id || xhr.responseJSON.errors.type || xhr.responseJSON.errors.count,
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
            $("#submit_order").on('click', function () {
                let submitUpdateUserElement = $(this);
                showProgressButton($(submitUpdateUserElement));
                $.ajax({
                    url: '/orders',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        "_token": "{{csrf_token()}}"
                    },
                    success: function (response) {
                        Swal.fire(
                            {
                                type: 'success',
                                text: 'سفارش با موفقیت ایجاد شد!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        setTimeout(() => {
                            window.location = '/orders/' + response['order']['id'];
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
                                    text: xhr.responseJSON.errors.id || xhr.responseJSON.errors.type || xhr.responseJSON.errors.count,
                                    confirmButtonText: 'باشه'
                                });
                        } else if (xhr.status === 403) {
                            console.log(xhr.responseJSON)
                            Swal.fire(
                                {
                                    title: 'خطا',
                                    type: 'error',
                                    text: xhr.responseJSON.message || 'خطای سرور ',
                                    confirmButtonText: 'باشه'
                                });
                        } else {
                            Swal.fire(
                                {
                                    title: 'خطا',
                                    type: 'error',
                                    text: xhr.responseJSON.message || xhr.responseJSON.error || 'خطای سرور ',
                                    confirmButtonText: 'باشه'
                                });
                        }
                    }
                });
            });
        });
    </script>
@endsection
