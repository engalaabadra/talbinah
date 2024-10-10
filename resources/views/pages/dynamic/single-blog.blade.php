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
		@include('layouts.slider')>
<!-- Main Start -->
		<main id="dc-main" class="dc-main dc-haslayout">
			<!-- About Welcome Start -->
			<!-- About Welcome Start -->
			<div class="dc-haslayout dc-main-section">
				<!-- User Listing Start-->
				<div class="container">
					<div class="{{session()->get('lang')=== 'ar'? 'row flex-row-reverse mx-auto w-100' : 'row mx-auto w-100'}}">

						<div class="col-md-8 col-xl-9 ">
							<div class="dc-runner">
								<figure class="dc-runner-img">
                                    @if($article->image)
										<img src="{{url('/'.$article->image->url)}}" style="height: 200px" alt="@lang('custom.img description')">
                                    @else
                                        <img src="{{url('/assets/images/logo/logo_footer.png')}}"  style="height: 200px" style="width: 756px;
                                        height: 521px;" alt="Image Description">
                                    @endif
								</figure>
								<div class="dc-runner-content">
                                    @foreach($article->keywords as $keyword)
									    <a href="javascript:void(0);">{{$keyword->name}}</a>
                                    @endforeach
									<div class="dc-runner-heading">
										<h3>{{$article->title}}</h3>
                                            <div><i class="ti-calendar"></i> {{$article->created_at}}</div>
									</div>

								</div>
							</div>
							<div class=" dc-para99">
								<div>
									<p class="dc-para">
                                        {{$article->description}}
                                    </p>

								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- User Listing End-->
			</div>
		</main>
		<!-- Main End -->
@endsection
