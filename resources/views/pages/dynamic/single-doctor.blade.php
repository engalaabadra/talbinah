@extends('layouts.main')
@section('meta')
    <title> {{$doctor->full_name ?? trans('admin/dashboard.doctors')}}</title>
    <meta name="title" content="Talbinah Blog ">
    <meta name="description" content="Explore Talbinah's blog for the latest articles and information on safety and health
    Mental . Learn advice from professional psychologists and mental health counselors.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://metatags.io">
    <meta property="og:title" content="Talbinah Blog ">
    <meta property="og:description" content="Explore Talbinah's blog for the latest articles and information on safety and health
    Mental . Learn advice from professional psychologists and mental health counselors.">
    <meta property="og:image" content="https://metatags.io/images/meta-tags.png">

    <!-- twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://metatags.io">
    <meta property="twitter:title" content="Talbinah Blog ">
    <meta property="twitter:description" content="Explore Talbinah's blog for the latest articles and information on safety and health
    Mental . Learn advice from professional psychologists and mental health counselors.">
    <meta property="twitter:image" content="https://metatags.io/images/meta-tags.png">
    <!-- Meta Tags Generated with https://metatags.io -->


@endsection

@section('main-container')

    <!-- Main Start -->
    <main id="dc-main" class="dc-main dc-haslayout">
        <!-- About Welcome Start -->
        <!-- About Welcome Start -->
        <div class="dc-haslayout dc-main-section">
            <!-- User Listing Start-->
            <div class="container">
                <div class="row">
                    <div id="dc-twocolumns" class="dc-twocolumns dc-haslayout">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 float-left">
                            <div class="dc-docsingle-header">
                                <figure class="dc-docsingleimg">
                                    <img src="{{$doctor->image ? url('/'.$doctor->image->url) : resolvePhoto()}}"
                                         style="width: 243px;" alt="@lang('custom.img description')">
                                </figure>
                                <div class="dc-docsingle-content">
                                    <div class="dc-title">
                                        @foreach($doctor->specialties as $specialty)
                                            <a href="javascript:void(0)" class="dc-docstatus">{{$specialty->name}}</a>
                                        @endforeach
                                        <h2><a href="javascript:void(0);">{{$doctor->fullname}} </a></h2>
                                        <ul class="dc-docinfo">
                                            <li>
                                                <em>@lang('admin/dashboard.hour_price')
                                                    ( {{$doctor->profile->price_half_hour ? $doctor->profile->price_half_hour * 2 : ''}} ) @lang('admin/dashboard.currency')</em>
                                            </li>
                                            <li>
                                                <span
                                                    class="dc-stars"><span></span></span><em>({{$doctor->reviewsDoctor ? count($doctor->reviewsDoctor) : '0'}})</em>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dc-description">
                                        <p>
                                            {{$doctor->profile->bio ?? trans('admin/dashboard.no_data_found')}}
                                        </p>
                                    </div>
                                    <div class="dc-btnarea">
                                        <a href="javascript:void(0);" class="dc-btn" data-toggle="modal"
                                           data-target="#register-model">@lang('admin/dashboard.book_now')</a>
                                    </div>
                                </div>
                            </div>
                            <div class="dc-docsingle-holder">
                                <ul class="dc-navdocsingletab nav navbar-nav">
                                    <li class="nav-item">
                                        <a id="userdetails-tab" data-toggle="tab"
                                           href="#userdetails">@lang('admin/dashboard.about_doc')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="feedback-tab" data-toggle="tab" href="#feedback">@lang('custom.Feedback')
                                            <span>({{count($doctor->reviewsDoctor)}})</span></a>
                                    </li>
                                </ul>
                                <div class="tab-content dc-haslayout">
                                    <div class="dc-contentdoctab dc-userdetails-holder tab-pane active show"
                                         id="userdetails">
                                        <div class="dc-aboutdoc dc-aboutinfo">
                                            <div class="dc-infotitle">
                                                <h3>@lang('admin/dashboard.about') <span
                                                        class="h3 font-weight-bold"> {{$doctor->full_name}} </span></h3>
                                            </div>
                                            <div class="dc-description">
                                                <p>
                                                    {{$doctor->profile->bio ?? trans('admin/dashboard.no_data_found')}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dc-contentdoctab dc-feedback-holder tab-pane" id="feedback">
                                        <div class="dc-feedback">
                                            <div class="dc-searchresult-head">
                                                <div class="dc-title">
                                                    <h4>@lang('admin/dashboard.patient_feedback') </h4></div>

                                            </div>
                                            <div class="dc-consultation-content dc-feedback-content">
                                                @foreach($doctor->reviewsDoctor as $review)
                                                    <div class="dc-consultation-details">
                                                        <figure class="dc-consultation-img">
                                                            <img src="{{resolvePhoto()}}"
                                                                 alt="@lang('custom.img description')">
                                                        </figure>
                                                        <div class="dc-consultation-title">
                                                            <h5>Anonymous Patient</h5>
                                                            <span>{{dateFormat($review->created_at,'Y-M-d')}}</span>
                                                        </div>
                                                        <div class="dc-description">
                                                            <p>
                                                                {{$review->description}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                {{--                                            <nav class="dc-pagination">--}}
                                                {{--                                            </nav>--}}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- User Listing End-->
        </div>
        <!-- Emerging Clients End -->

    </main>
    <!-- Main End -->


@endsection
