@extends('layouts.main')
@section('meta')
    <title> @lang('custom.Talbinah Blog')</title>
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
            <div class="{{session()->get('lang')=== 'ar' ? 'row flex-row-reverse mx-auto w-100' : 'row mx-auto w-100'}}">
                <div class="col-md-4 col-xl-3 float-left order-last order-md-first">
                    <aside id="dc-sidebar" class="dc-sidebar dc-sidebar-grid float-left mt-md-0">
                        <div class="dc-widget dc-categories">
                            <div class="dc-widgettitle">
                                <h3>@lang('custom.Articles')</h3>
                            </div>
                            <div class="dc-widgetcontent">
                                <ul class="dc-categories-content">
                                    @foreach($articlesCategories as $category)
                                        <li><a href="{{route('single-blog',$category->id)}}">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                    </aside>
                </div>
                <div class="col-md-8 col-xl-9 float-left">
                    <div class="dc-articlesholder">
                        <div class="row dc-articlesrow">
                            @foreach($articles as $article)
                                <div class="col-12 col-sm-6 col-xl-4">
                                    <div class="dc-article" >
                                        <figure class="dc-articleimg">
                                            @if($article->image)
                                                <img src="{{url('/'.$article->image->url)}}"   alt="@lang('custom.img description')">
                                            @else
                                                <img src="{{url('/assets/images/logo/logo_footer.png')}}"    alt="@lang('custom.img description')">
                                            @endif
                                        </figure>
                                        <div class="dc-articlecontent">
                                            <div class="dc-title dc-ellipsis dc-titlep">
                                                @foreach($article->keywords as $keyword)
                                                    <a href="{{ route('single-blog',['id'=>$article->id]) }}" class="dc-articleby">{{$keyword->name}}</a>
                                                @endforeach
                                                <h3><a href="{{ route('single-blog',['id'=>$article->id]) }}">{{$article->title}}</a></h3>
                                                <span class="dc-datetime"><i class="ti-calendar"></i> {{$article->created_at}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="pagination-cont">
                            <div class="d-flex flex-wrap py-2 mr-3 justify-content-center">
                                {{$articles->links("pagination::bootstrap-4")}}
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
