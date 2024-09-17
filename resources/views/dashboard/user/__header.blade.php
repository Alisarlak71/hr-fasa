<!--begin::Header-->
<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}"
     data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}"
     data-kt-sticky-animation="false">
    <!--begin::Header container-->
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
         id="kt_app_header_container">
        <!--begin::Sidebar mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="مشاهده">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <!--end::Sidebar mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="#" class="d-lg-none">
                <img alt="Logo" src="{{asset('assets/media/logo.png')}}" class="h-30px"/>
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Header wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <!--begin::Menu wrapper-->
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                 data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                 data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                 data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                 data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                 data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <!--begin::Menu-->
                <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
                     id="kt_app_header_menu" data-kt-menu="true">

                </div>
                <!--end::Menu-->
            </div>
            <!--end::Menu wrapper-->
            <!--begin::Navbar-->
            <div class="app-navbar flex-shrink-0">

                <!--begin::اعلان ها-->
                <div class="app-navbar-item ms-1 ms-md-4">
                    <!--begin::Menu- wrapper-->
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true"
                         id="kt_menu_notifications">
                        <!--begin::Heading-->
                        <div class="d-flex flex-column bgi-no-repeat rounded-top"
                             style="background-image:url('assets/media/misc/menu-header-bg.jpg')">
                            <!--begin::Title-->
                            <h3 class="text-white fw-semibold px-9 mt-10 mb-6"> سبد خرید
                                <span class="fs-8 opacity-75 ps-3">{{$card['items']->count()}} مورد </span></h3>
                            <!--end::Title-->
                            <!--begin::Tabs-->

                            <!--end::Tabs-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Tab content-->
                        <div class="container h-auto p-5">
                            <ul class="list-unstyled p-5" style="max-height: 500px; overflow: scroll">
                                @foreach($card['items'] as $cardItem)
                                    <li class="mb-3 pb-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <img class="w-50px img-thumbnail" alt="card item"
                                                     src="{{$cardItem->orderable->image->download_link ?? asset('assets/media/product/services.png')}}"/>
                                                <div class="ml-4">
                                                    <p class="mb-1 text-gray-700">{{$cardItem->orderable->title}}</p>
                                                    <p class="mb-0 text-primary">{{$cardItem->orderable->price * $cardItem->count}}
                                                        ریال</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <a class="btn btn-outline-danger btn-sm mr-2 kt_remove_from_card_request "
                                                   data-id="{{$cardItem->orderable_id}}"
                                                   data-type="{{($cardItem->orderable_type===\App\Models\Product::class?'product':'subscription')}}">-</a>
                                                <span class="mx-3">{{$cardItem->count}}</span>
                                                <a class="btn btn-outline-success btn-sm kt_add_to_card_request"
                                                   data-id="{{$cardItem->orderable_id}}"
                                                   data-type="{{($cardItem->orderable_type===\App\Models\Product::class?'product':'subscription')}}">+</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="total mt-4 pt-3 border-top row">
                                <h5><span class="text-muted">جمع کل :</span> {{$card['total_price']}} ریال</h5>
                                <a class="btn btn-primary mt-3" id="submit_order">ثبت سفارش</a>
                            </div>

                        </div>
                        <!--end::Tab content-->
                    </div>
                    <!--end::Menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::اعلان ها-->
                @if(Auth::user()->is_admin && (Auth::user()->canDo('userList') || Auth::user()->canDo('userAccount') || Auth::user()->canDo('userDocs') || Auth::user()->canDo('userPresent')))
                    <div class="app-navbar-item ms-1 ms-md-4">
                        <a href="/admin/users" class="btn btn-sm btn-light btn-primary">
                            بخش مدیریت</a>
                    </div>
                @endif

                <!--begin::کاربر menu-->
                <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-35px"
                         data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                         data-kt-menu-placement="bottom-end">
                        <img src="{{Auth::user()->photo->download_link??asset('assets/media/avatars/blank.png')}}"
                             class="rounded-3" alt="user"/>
                    </div>
                    <!--begin::کاربر account menu-->
                    <div
                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                            data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo"
                                         src="{{Auth::user()->photo->download_link??asset('assets/media/avatars/blank.png')}}"/>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::کاربرname-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">کاربر
                                        <span
                                                class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">فعال</span>
                                    </div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">کاربر</a>
                                </div>
                                <!--end::کاربرname-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="/profile" class="menu-link px-5">پروفایل من</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="/sign_ins" class="menu-link px-5">تاریخچه ورود ها</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="/logout"
                               class="menu-link px-5">خروج</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::کاربر account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::کاربر menu-->
                <!--begin::Header menu toggle-->

                <!--end::Header menu toggle-->
                <!--begin::کناری toggle-->
                <!--end::Header menu toggle-->
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Header wrapper-->
    </div>
    <!--end::Header container-->
</div>

<!--end::Header-->
