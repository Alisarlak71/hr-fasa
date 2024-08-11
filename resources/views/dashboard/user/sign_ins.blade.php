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
                    ورود ها</h1>
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
                            <span class="card-label fw-bold fs-3 mb-1">لیست ورود ها</span>
                            <span class="text-muted mt-1 fw-semibold fs-7"></span>
                        </h3>
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
                                    <th class="p-0 ">ip</th>
                                    <th class="p-0 ">دستگاه</th>
                                    <th class="p-0 ">تاریخ</th>
                                </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="transaction_table" id="transaction_table">
                                @foreach($sign_ins as $sign_in)
                                    <tr>
                                        <td class="text-table">
                                            {{$sign_in->ip}}
                                        </td>
                                        <td class="text-table">
                                            {{$sign_in->user_agent}}
                                        </td>
                                        <td class="text-table">
                                            {{ \Morilog\Jalali\Jalalian::forge($sign_in->created_at)->format('%A, %d %B %y')}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            {{ $sign_ins->links('pagination::bootstrap-5') }}
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

    <script>
        setTimeout(() => {
            window.Echo.channel('transactionImport')
                .listen('ImportDataProcessed', (e) => {
                    console.log(e.data);
                });
        }, 1000);
    </script>
@endsection
