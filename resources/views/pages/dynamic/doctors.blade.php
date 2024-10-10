@extends('layouts.main')
@section('meta')
    <title> @lang('admin/dashboard.doctors')</title>
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
    @include('layouts.slider')

    <main id="dc-main" class="dc-main dc-haslayout">
        <!-- About Welcome Start -->
        <!-- About Welcome Start -->
        <div class="dc-haslayout dc-main-section">
            <!-- User Listing Start-->
            <div class="container">
                <div class="row">
                    <div id="dc-twocolumns" class="dc-twocolumns dc-haslayout">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 float-left">
                            <div class="dc-searchresult-holder">
                                <div class="dc-searchresult-grid">
                                    <div class="row">
                                        @forelse($doctors->items() as $doctor)
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                                                <div class="dc-docpostholder">
                                                    <figure class="dc-docpostimg">
                                                            <img src="{{$doctor->image ? url('/'.$doctor->image->url) : resolvePhoto()}}"
                                                                 alt="@lang('custom.img description')">
                                                    </figure>
                                                    <div class="dc-docpostcontent">
                                                        <div class="dc-title">
                                                            @forelse($doctor->specialties as $specialty)
                                                                <a href="javascript:void(0)"
                                                                   class="dc-docstatus">{{$specialty->name }}</a>
                                                            @empty

                                                            <a href="javascript:void(0)"
                                                                       class="dc-docstatus">---</a>
                                                            @endforelse
                                                            <h3>
                                                                <a href="{{ route('single-doctor',['id'=>$doctor->id]) }}">{{$doctor->full_name ?? '___'}}</a>
                                                                @if($doctor->full_name)
                                                                <i class="fa fa-award dc-awardtooltip"><em>Medical
                                                                        Registration Verified</em></i> <i
                                                                    class="fa fa-check-circle dc-awardtooltip"><em>Medical
                                                                        Registration Verified</em></i>
                                                                @endif
                                                            </h3>
                                                            <ul class="dc-docinfo">
                                                                <li>
                                                                    @php
                                                                        if($doctor->profile){
                                                                            if ($doctor->profile->bio && strlen($doctor->profile->bio) > $maxLengthBio) {
                                                                                $doctor->profile->bio = substr($doctor->profile->bio, 0, $maxLengthBio) . '...';
                                                                            } else {
                                                                                $doctor->profile->bio;
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <em>{{$doctor->profile->bio ?? trans('admin/dashboard.no_data_found')}}</em>
                                                                </li>
                                                                <li>
                                                                    <span class="dc-stars"><span></span></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="dc-doclocation">
                                                                <span> {{$doctor->country ? $doctor->country->name : '---'}}  <i
                                                                        class="ti-direction-alt"></i></span>

                                                            <a href="{{ route('single-doctor',['id'=>$doctor->id]) }}"
                                                               class="dc-btn" style="color: #284A6E">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="h2 text-center">@lang('admin/dashboard.no_data_found')</div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <nav class="dc-pagination">
                                <div class="pagination-cont">
                                    <div class="d-flex flex-wrap py-2 mr-3 justify-content-center">
                                        {{$doctors->links("pagination::bootstrap-4")}}
                                    </div>
                                </div>
                            </nav>
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
    </main>
@endsection
