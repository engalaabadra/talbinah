@extends('layouts.dashboard.master')
@section('page_header')
    <li class="breadcrumb-item">
        <a href="" class="text-muted">{{__('admin/dashboard.profile_info')}}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="" class="text-muted">{{Auth::user()->name??'-'}}</a>
    </li>
@endsection
@section('content')
{{--    @dd($errors)--}}
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="d-flex flex-row">
                <div class="flex-row-auto offcanvas-phone w-250px w-xxl-350px" id="kt_profile_aside">
                    <div class="card card-custom card-stretch">
                        <div class="card-body pt-4">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                    <div class="symbol-label" style="background-image:url('{{ auth()->user()->photo ?? resolvePhoto(null,'admin')}}')">

                                    </div>
                                    <i class="symbol-badge bg-success"></i>
                                </div>
                                <div>
                                    <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                                        {{auth()->user()->name??'-'}}</a>
{{--                                    <div class="text-muted">{{Auth::user()->roles()->first()->label}}</div>--}}
                                </div>
                            </div>
                            <div class="py-9">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">{{__('admin/dashboard.email')}}:</span>
                                    <a href="#" class="text-muted text-hover-primary">{{auth()->user()->email}}</a>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">{{__('admin/dashboard.phone')}}:</span>
                                    <span class="text-muted">{{auth()->user()->phone}}</span>
                                </div>
                            </div>
                            <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                                <div class="navi-item mb-2">
                                    <a href="{{route('admin.profile.index')}}"
                                       class="navi-link py-4 {{ request()->is('*/profile') ? 'active' : '' }} ">
                                            <span class="navi-icon mr-2">
                                                <span class="svg-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                         width="24px" height="24px" viewBox="0 0 24 24"
                                                         version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                           fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                                            <path
                                                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                opacity="0.3"/>
                                                            <path
                                                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                                fill="#000000" fill-rule="nonzero"/>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                        <span
                                            class="navi-text font-size-lg">{{__('admin/dashboard.personal_info')}}</span>
                                    </a>
                                </div>
                                <div class="navi-item mb-2 ">
                                    <a href="{{route('admin.profile.changePassword')}}"
                                       class="navi-link py-4 {{ request()->is('*/profile/changePassword') ? 'active' : '' }}">
                                        <span class="navi-icon mr-2">
                                            <span class="svg-icon">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Shield-user.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                     version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                       fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path
                                                            d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                                                            fill="#000000" opacity="0.3"/>
                                                        <path
                                                            d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z"
                                                            fill="#000000" opacity="0.3"/>
                                                        <path
                                                            d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                                                            fill="#000000" opacity="0.3"/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <span class="navi-text font-size-lg">{{__('admin/dashboard.change_password')}}</span>
                                        <span class="navi-label"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('profile_content')
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('dashboard_assets/js/pages/custom/profile/profile.js')}}"></script>
@endpush
