@extends('dashboard._html')

@section('head-links')
    @parent

@endsection

@section('content')
    @include('dashboard.admin.__header')
    <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
        @include('dashboard.admin.__sidebar')

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
                        <a href="https://fasatech.ir/" target="_blank" class="text-gray-800 text-hover-primary">فناوری سایپا ارتباط</a>
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

@endsection
