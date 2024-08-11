@extends('dashboard.user._layout')

@section('title', $title)

@section('head-rest')
    @vite('resources/js/app.js')
    <style>
        .w-50px {
            width: 50px;
        }

        .img-thumbnail {
            border-radius: 0.25rem;
        }

        .card-title {
            font-weight: bold;
        }

        .card-text {
            margin-bottom: 0.75rem;
        }

        .badge-info {
            background-color: #17a2b8;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #e9ecef;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
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
                    سفارش</h1>
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
                    <li class="breadcrumb-item text-muted">سفارش</li>
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
                    <div class="card h-md-100">
                        <!--begin::Body-->
                        <div class="card-body p-5">
                            <h1>جزییات سفارش </h1>
                            <div class="container my-5">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">سفارش #{{ $order->id }}</h5>
                                        <p class="card-text"><strong>مجموع پرداختی:</strong> <span class="text-success">{{ number_format($order->total_price) }} ریال</span>
                                        </p>
                                        <p class="card-text"><strong>وضعیت:</strong> <span
                                                    class="badge {{ getStatusBadgeClass($order->status) }}">{{ getStatusLabel($order->status) }}</span>
                                        </p>
                                    </div>
                                </div>

                                <h2 class="mb-4">ایتم های سفارش</h2>
                                <ul class="list-group mb-4">
                                    @foreach($order->items as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                            <div class="d-flex align-items-center">
                                                <img class="w-50px img-thumbnail mr-3" alt="بدون تصویر"
                                                     src="{{ $item->orderable->image->download_link ?? asset('assets/media/product/services.png') }}"/>
                                                <div class="p-5">
                                                    <h5 class="mb-1">{{ $item->orderable->title }}</h5>
                                                    <p class="mb-1 text-muted"><strong>قیمت
                                                            واحد:</strong> {{ number_format($item->unit_price) }} ریال
                                                    </p>
                                                    <p class="mb-1 text-muted">
                                                        <strong>مجموع:</strong> {{ number_format($item->total_price) }}
                                                        ریال</p>
                                                    <p class="mb-0 text-muted">
                                                        <strong>تعداد:</strong> {{ $item->count }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="text-center">
                                    @if($order->status === \App\Enums\OrderStatuses::WAIT_FOR_PAYMENT)
                                        <button class="btn btn-danger btn-lg"
                                                onclick="location.href='/transaction/portal/{{ $order->id }}'">پرداخت
                                            صورت
                                            حساب
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--end: کارت Body-->
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
@endsection
