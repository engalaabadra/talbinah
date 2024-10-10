@extends('layouts.dashboard.master')
@section('content')
    <div class="content flex-column-fluid" id="kt_content">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-50 symbol-lg-120">
                            <img alt="Pic"
                                 src="{{$doctor->image ? url($doctor->image->url) : resolvePhoto()}}"/>
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <!--begin::User-->
                            <div class="mr-3">
                                <div class="d-flex align-items-center mr-3">
                                    <!--begin::Name-->
                                    <a href="#"
                                       class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                        {{$doctor->full_name}}
                                    </a>
                                    <!--end::Name-->
                                </div>

                                <!--begin::Contacts-->
                                <div class="d-flex flex-wrap my-2">
                                    <a href="mailto:{{$doctor->email}}"
                                       class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path
                                                        d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                        fill="#000000"/>
                                                    <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"/>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        {{$doctor->email}}
                                    </a>
                                    <a href="" class="text-muted text-hover-primary font-weight-bold">
                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/iPhone-X.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path
                                                        d="M8,2.5 C7.30964406,2.5 6.75,3.05964406 6.75,3.75 L6.75,20.25 C6.75,20.9403559 7.30964406,21.5 8,21.5 L16,21.5 C16.6903559,21.5 17.25,20.9403559 17.25,20.25 L17.25,3.75 C17.25,3.05964406 16.6903559,2.5 16,2.5 L8,2.5 Z"
                                                        fill="#000000" opacity="0.3"/>
                                                    <path
                                                        d="M8,2.5 C7.30964406,2.5 6.75,3.05964406 6.75,3.75 L6.75,20.25 C6.75,20.9403559 7.30964406,21.5 8,21.5 L16,21.5 C16.6903559,21.5 17.25,20.9403559 17.25,20.25 L17.25,3.75 C17.25,3.05964406 16.6903559,2.5 16,2.5 L8,2.5 Z M8,1 L16,1 C17.5187831,1 18.75,2.23121694 18.75,3.75 L18.75,20.25 C18.75,21.7687831 17.5187831,23 16,23 L8,23 C6.48121694,23 5.25,21.7687831 5.25,20.25 L5.25,3.75 C5.25,2.23121694 6.48121694,1 8,1 Z M9.5,1.75 L14.5,1.75 C14.7761424,1.75 15,1.97385763 15,2.25 L15,3.25 C15,3.52614237 14.7761424,3.75 14.5,3.75 L9.5,3.75 C9.22385763,3.75 9,3.52614237 9,3.25 L9,2.25 C9,1.97385763 9.22385763,1.75 9.5,1.75 Z"
                                                        fill="#000000" fill-rule="nonzero"/>
                                                </g>
                                            </svg><!--end::Svg Icon-->
                                        </span>
                                        {{fullNumber($doctor->phone_no,$doctor->country_id)}} +
                                    </a>
                                </div>
                                <!--end::Contacts-->
                            </div>

                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <!--begin::Description-->
                            <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                                {{$doctor->profile->bio}}
                            </div>

                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>
        <!--end::Card-->
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-4">

                <!--begin::Card-->
                <div class="card card-custom">
                    <!--begin::Header-->
                    <div class="card-header h-auto py-4">
                        <div class="card-title">
                            <h3 class="card-label">@lang('admin/dashboard.personal_info')</h3>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-4">
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">@lang('admin/dashboard.name') :</label>
                            <div class="col-8">
                                <span class="form-control-plaintext font-weight-bolder">{{$doctor->full_name}}</span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            @php
                                $avg_doctor_rate = 0 ;
                                $sum_doctor_rate = 0;
                                if ($doctor->reviewsDoctor){
                                    foreach ($doctor->reviewsDoctor as $rat){
                                        $sum_doctor_rate += $rat->rating ;
                                        $avg_doctor_rate = $sum_doctor_rate / count($doctor->reviewsDoctor) ;
                                    }
                                }
                            @endphp
                            <label class="col-4 col-form-label">@lang('admin/dashboard.rating') :</label>
                            <div class="col-8">
                                <span
                                    class=" form-control-plaintext font-weight-bolder"> <span
                                        class="text-primary">{{$avg_doctor_rate}}</span></span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">@lang('admin/dashboard.revenue') :</label>
                            <div class="col-8">
                                <span class="form-control-plaintext">
                                <span
                                    class="font-weight-bolder">{{$doctor->wallet->balance}} @lang('admin/dashboard.currency')</span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">@lang('admin/dashboard.reservations') :</label>
                            <div class="col-8">
                                <span class="form-control-plaintext">
                                <span
                                    class="font-weight-bolder">{{$doctor->reservationsDoctor()->count()}}</span>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">@lang('admin/dashboard.specialist'):</label>
                            <div class="col-8">
                                <span
                                    class="form-control-plaintext font-weight-bolder">{{$doctor->specialties[0]->name}}</span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">@lang('admin/dashboard.email') :</label>
                            <div class="col-8">
                                <span class="form-control-plaintext font-weight-bolder">{{$doctor->email}}</span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">@lang('admin/dashboard.license_number') :</label>
                            <div class="col-8">
                                <span
                                    class="form-control-plaintext font-weight-bolder">{{$doctor->profile->license_number ?? '---' }}</span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">@lang('admin/dashboard.status') :</label>
                            <div class="col-8">
                                <span id="show-doctor-status"
                                      class="badge {{$doctor->active == 1 ? 'badge-primary' : 'badge-danger'}} badge-lg font-size-h6">{{$doctor->active == 1 ? __('admin/dashboard.active') : __('admin/dashboard.non_active')}}</span>
                                <a
                                    class="change-doctor-status" id="change-status"
                                    data-url="{{ route('admin.doctors.change_status', $doctor->id) }}"
                                    data-doctor_status="{{ $doctor->active }}"
                                ><i class="flaticon2-edit btn btn-sm btn-clean btn-success btn-icon"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->

                </div>
                <!--end::Card-->
            </div>
            {{--            <div class="col-xl-8">--}}
            {{--                <!--begin::Card-->--}}
            {{--                <div class="card card-custom gutter-b">--}}
            {{--                    <!--begin::Header-->--}}
            {{--                    <div class="card-header card-header-tabs-line">--}}
            {{--                        <div class="card-toolbar">--}}
            {{--                            <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-bold nav-tabs-line-3x"--}}
            {{--                                role="tablist">--}}
            {{--                                <li class="nav-item">--}}
            {{--                                    <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_1">--}}
            {{--                                        <span class="nav-icon mr-2">--}}
            {{--                                            <span class="svg-icon mr-3">--}}
            {{--                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->--}}
            {{--                                                <svg xmlns="http://www.w3.org/2000/svg"--}}
            {{--                                                     xmlns:xlink="http://www.w3.org/1999/xlink"--}}
            {{--                                                     width="24px" height="24px"--}}
            {{--                                                     viewBox="0 0 24 24" version="1.1">--}}
            {{--                                                    <g stroke="none" stroke-width="1"--}}
            {{--                                                       fill="none" fill-rule="evenodd">--}}
            {{--                                                        <rect x="0" y="0" width="24"--}}
            {{--                                                              height="24"/>--}}
            {{--                                                        <path--}}
            {{--                                                            d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"--}}
            {{--                                                            fill="#000000"/>--}}
            {{--                                                        <circle fill="#000000" opacity="0.3"--}}
            {{--                                                                cx="18.5" cy="5.5" r="2.5"/>--}}
            {{--                                                    </g>--}}
            {{--                                                </svg>--}}
            {{--                                                <!--end::Svg Icon-->--}}
            {{--                                            </span>--}}
            {{--                                        </span>--}}
            {{--                                        <span class="nav-text">@lang('admin/dashboard.national_identity')</span>--}}
            {{--                                    </a>--}}
            {{--                                </li>--}}
            {{--                                <li class="nav-item">--}}
            {{--                                    <a class="nav-link " data-toggle="tab" href="#kt_apps_contacts_view_tab_2">--}}
            {{--                                        <span class="nav-icon mr-2">--}}
            {{--                                            <span class="svg-icon mr-3">--}}
            {{--                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->--}}
            {{--                                                <svg xmlns="http://www.w3.org/2000/svg"--}}
            {{--                                                     xmlns:xlink="http://www.w3.org/1999/xlink"--}}
            {{--                                                     width="24px" height="24px"--}}
            {{--                                                     viewBox="0 0 24 24" version="1.1">--}}
            {{--                                                    <g stroke="none" stroke-width="1"--}}
            {{--                                                       fill="none" fill-rule="evenodd">--}}
            {{--                                                        <rect x="0" y="0" width="24"--}}
            {{--                                                              height="24"/>--}}
            {{--                                                        <path--}}
            {{--                                                            d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"--}}
            {{--                                                            fill="#000000"/>--}}
            {{--                                                        <circle fill="#000000" opacity="0.3"--}}
            {{--                                                                cx="18.5" cy="5.5" r="2.5"/>--}}
            {{--                                                    </g>--}}
            {{--                                                </svg>--}}
            {{--                                                <!--end::Svg Icon-->--}}
            {{--                                            </span>--}}
            {{--                                        </span>--}}
            {{--                                        <span class="nav-text">@lang('admin/dashboard.driving_license')</span>--}}
            {{--                                    </a>--}}
            {{--                                </li>--}}

            {{--                                <li class="nav-item ">--}}
            {{--                                    <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_3">--}}
            {{--                                        <span class="nav-icon mr-2">--}}
            {{--                                            <span class="svg-icon mr-3">--}}
            {{--                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat-check.svg-->--}}
            {{--                                                <svg xmlns="http://www.w3.org/2000/svg"--}}
            {{--                                                     xmlns:xlink="http://www.w3.org/1999/xlink"--}}
            {{--                                                     width="24px" height="24px"--}}
            {{--                                                     viewBox="0 0 24 24" version="1.1">--}}
            {{--                                                    <g stroke="none" stroke-width="1"--}}
            {{--                                                       fill="none" fill-rule="evenodd">--}}
            {{--                                                        <rect x="0" y="0" width="24"--}}
            {{--                                                              height="24"/>--}}
            {{--                                                        <path--}}
            {{--                                                            d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z"--}}
            {{--                                                            fill="#000000" fill-rule="nonzero"--}}
            {{--                                                            opacity="0.3"/>--}}
            {{--                                                        <path--}}
            {{--                                                            d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z"--}}
            {{--                                                            fill="#000000"/>--}}
            {{--                                                    </g>--}}
            {{--                                                </svg>--}}
            {{--                                                <!--end::Svg Icon-->--}}
            {{--                                            </span>--}}
            {{--                                        </span>--}}
            {{--                                        <span class="nav-text">@lang('admin/dashboard.car_images')</span>--}}
            {{--                                    </a>--}}
            {{--                                </li>--}}
            {{--                                <li class="nav-item mr-3">--}}
            {{--                                    <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_4">--}}
            {{--                                        <span class="nav-icon mr-2">--}}
            {{--                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo11\dist/../src/media/svg/icons\Code\Time-schedule.svg--><svg--}}
            {{--                                                    xmlns="http://www.w3.org/2000/svg"--}}
            {{--                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"--}}
            {{--                                                    height="24px" viewBox="0 0 24 24" version="1.1">--}}
            {{--                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
            {{--                                                    <rect x="0" y="0" width="24" height="24"/>--}}
            {{--                                                    <path--}}
            {{--                                                        d="M10.9630156,7.5 L11.0475062,7.5 C11.3043819,7.5 11.5194647,7.69464724 11.5450248,7.95024814 L12,12.5 L15.2480695,14.3560397 C15.403857,14.4450611 15.5,14.6107328 15.5,14.7901613 L15.5,15 C15.5,15.2109164 15.3290185,15.3818979 15.1181021,15.3818979 C15.0841582,15.3818979 15.0503659,15.3773725 15.0176181,15.3684413 L10.3986612,14.1087258 C10.1672824,14.0456225 10.0132986,13.8271186 10.0316926,13.5879956 L10.4644883,7.96165175 C10.4845267,7.70115317 10.7017474,7.5 10.9630156,7.5 Z"--}}
            {{--                                                        fill="#000000"/>--}}
            {{--                                                    <path--}}
            {{--                                                        d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z"--}}
            {{--                                                        fill="#000000" opacity="0.3"/>--}}
            {{--                                                </g>--}}
            {{--                                            </svg><!--end::Svg Icon--></span>--}}

            {{--                                        </span>--}}
            {{--                                        <span class="nav-text">@lang('admin/dashboard.fees')</span>--}}
            {{--                                    </a>--}}
            {{--                                </li>--}}
            {{--                            </ul>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <!--end::Header-->--}}
            {{--                    <!--begin::Body-->--}}
            {{--                    <div class="card-body px-0">--}}
            {{--                        <div class="tab-content pt-5">--}}
            {{--                            <!--begin::Tab Content-->--}}
            {{--                            <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">--}}
            {{--                                <div class="container">--}}
            {{--                                    <div class="row">--}}
            {{--                                        @if($doctor->national_identity)--}}
            {{--                                            <div class="col-md-4">--}}
            {{--                                                <div class="card card-custom card-stretch gutter-b">--}}
            {{--                                                    <div class="card-body">--}}
            {{--                                                        <div class="d-flex justify-content-between flex-column h-100">--}}
            {{--                                                            <div class="h-100">--}}
            {{--                                                                <div class="d-flex flex-column flex-center">--}}
            {{--                                                                    <div--}}
            {{--                                                                        class="bgi-no-repeat bgi-size-cover rounded min-h-250px w-100"--}}
            {{--                                                                        style="    background-size: contain; background-image: url('{{$doctor->national_identity ?? resolvePhoto()}}')">--}}
            {{--                                                                    </div>--}}
            {{--                                                                </div>--}}
            {{--                                                            </div>--}}
            {{--                                                        </div>--}}
            {{--                                                    </div>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        @else--}}
            {{--                                            <h1 class="text-center m-15">@lang('admin/dashboard.no_data_found')</h1>--}}

            {{--                                        @endif--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">--}}
            {{--                                <div class="container">--}}
            {{--                                    <div class="row">--}}
            {{--                                        @if($doctor->driving_license)--}}
            {{--                                            <div class="col-md-6">--}}
            {{--                                                <div class="card card-custom card-stretch gutter-b">--}}
            {{--                                                    <div class="card-body">--}}
            {{--                                                        <div class="d-flex justify-content-between flex-column h-100">--}}
            {{--                                                            <div class="h-100">--}}
            {{--                                                                <div class="d-flex flex-column flex-center">--}}
            {{--                                                                    <div--}}
            {{--                                                                        class="bgi-no-repeat bgi-size-cover rounded min-h-250px w-100"--}}
            {{--                                                                        style="    background-size: contain; background-image: url('{{$doctor->driving_license ?? resolvePhoto()}}')">--}}
            {{--                                                                    </div>--}}
            {{--                                                                </div>--}}
            {{--                                                            </div>--}}
            {{--                                                        </div>--}}
            {{--                                                    </div>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        @else--}}
            {{--                                            <h1 class="text-center m-15">@lang('admin/dashboard.no_data_found')</h1>--}}

            {{--                                        @endif--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">--}}
            {{--                                <div class="container">--}}
            {{--                                    <div class="row">--}}
            {{--                                        @forelse($doctor->car_image as $image)--}}
            {{--                                            <div class="col-md-4">--}}
            {{--                                                <div class="card card-custom card-stretch gutter-b">--}}
            {{--                                                    <div class="card-body">--}}
            {{--                                                        <div class="d-flex justify-content-between flex-column h-100">--}}
            {{--                                                            <div class="h-100">--}}
            {{--                                                                <div class="d-flex flex-column flex-center">--}}
            {{--                                                                    <div--}}
            {{--                                                                        class="bgi-no-repeat bgi-size-cover rounded min-h-250px w-100"--}}
            {{--                                                                        style="    background-size: contain; background-image: url('{{$image ?? resolvePhoto()}}')">--}}

            {{--                                                                    </div>--}}
            {{--                                                                </div>--}}
            {{--                                                            </div>--}}
            {{--                                                        </div>--}}
            {{--                                                    </div>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        @empty--}}
            {{--                                            <h1 class="text-center m-15">@lang('admin/dashboard.no_data_found')</h1>--}}
            {{--                                        @endforelse--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}


            {{--                            --}}{{--                            <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">--}}
            {{--                            --}}{{--                                <div class="col-xl-12">--}}
            {{--                            --}}{{--                                    <div class="card card-custom card-stretch gutter-b">--}}

            {{--                            --}}{{--                                        <div class="card-header border-0">--}}
            {{--                            --}}{{--                                            <h3 class="card-title font-weight-bolder text-dark">Driver Travel--}}
            {{--                            --}}{{--                                                Fees</h3>--}}
            {{--                            --}}{{--                                            <div class="card-toolbar">--}}
            {{--                            --}}{{--                                                <div class="dropdown dropdown-inline">--}}
            {{--                            --}}{{--                                                </div>--}}
            {{--                            --}}{{--                                            </div>--}}
            {{--                            --}}{{--                                        </div>--}}

            {{--                            --}}{{--                                        <div class="card-body pt-2">--}}
            {{--                            --}}{{--                                            @forelse($doctor->fees as $fee)--}}
            {{--                            --}}{{--                                                <div class="d-flex flex-wrap align-items-center mb-10">--}}
            {{--                            --}}{{--                                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">--}}
            {{--                            --}}{{--                                                        <a href="#"--}}
            {{--                            --}}{{--                                                           class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">--}}
            {{--                            --}}{{--                                                            {{$fee->description}}--}}
            {{--                            --}}{{--                                                        </a>--}}
            {{--                            --}}{{--                                                        <span--}}
            {{--                            --}}{{--                                                            class="text-muted font-weight-bold my-1 font-size-h5">{{$fee->destination}} kilometer </span>--}}
            {{--                            --}}{{--                                                    </div>--}}
            {{--                            --}}{{--                                                    <!--end::Title-->--}}
            {{--                            --}}{{--                                                    <!--begin::Info-->--}}
            {{--                            --}}{{--                                                    <div class="d-flex align-items-center py-lg-0 py-2">--}}
            {{--                            --}}{{--                                                        <div class="d-flex flex-column text-right">--}}
            {{--                            --}}{{--                                                            <span--}}
            {{--                            --}}{{--                                                                class="text-dark-75 font-weight-bolder font-size-h4">{{number_format($service->price,2)}}</span>--}}
            {{--                            --}}{{--                                                        </div>--}}
            {{--                            --}}{{--                                                    </div>--}}
            {{--                            --}}{{--                                                    <!--end::Info-->--}}
            {{--                            --}}{{--                                                </div>--}}
            {{--                            --}}{{--                                            @empty--}}
            {{--                            --}}{{--                                                <h1 class="text-center m-15">No Data Found</h1>--}}
            {{--                            --}}{{--                                            @endforelse--}}
            {{--                            --}}{{--                                        </div>--}}
            {{--                            --}}{{--                                    </div>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.change-doctor-status').on('click', function () {
                let button = $(this);
                let doctorStatus = button.data('doctor_status');
                let newStatus = '';
                if (doctorStatus === 1) {
                    newStatus = 0;
                } else if (doctorStatus === 0) {
                    newStatus = 1;
                }

                if (doctorStatus !== null) {
                    $.ajax({
                        type: 'POST',
                        url: button.data('url'),
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: newStatus
                        },
                        success: function (response) {
                            if (response.status === 1) {
                                $('#show-doctor-status').text('@lang('admin/dashboard.active')').removeClass('badge-danger').addClass('badge-primary');
                            } else {
                                $('#show-doctor-status').text('@lang('admin/dashboard.non_active')').removeClass('badge-primary').addClass('badge-danger');
                            }

                            $('#change-status').data('doctor_status', response.status);
                            toastr.success(response.message);
                        },
                    });
                }
            });
        });

    </script>
@endpush
