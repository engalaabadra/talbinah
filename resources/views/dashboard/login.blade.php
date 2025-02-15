@extends('layouts.dashboard.app')
@push('style')
    <link href="{{asset('dashboard_assets/css/pages/login/login-4.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('pages')
    <div class="login login-4 wizard d-flex flex-column flex-lg-row flex-column-fluid">
        <div
            class="login-container order-2 order-lg-1 d-flex flex-center flex-row-fluid px-7 pt-lg-0 pb-lg-0 pt-4 pb-6 bg-white">
            <div class="login-content d-flex flex-column pt-lg-0 pt-12">
                <a href="#" class="login-logo pb-xl-20 pb-15">
                    <img src="{{asset('dashboard_assets/logo.png')}}" style="height: 140px" alt=""/>
                </a>
                <div class="login-form">
                    <form class="form" action="{{route('admin.login')}}" method="post">
                        @csrf
                        <div class="pb-5 pb-lg-15">
                            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">@lang('admin/dashboard.sign_in')</h3>
                        </div>

                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">@lang('admin/dashboard.email')</label>
                            <input
                                class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0  {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                type="email" value="{{ old('email')}}" name="email" autocomplete="off"/>
                            <div class="invalid-feedback" style="padding-right: 0">
                                <strong>{{ $errors->has('email') ? $errors->first('email') : '' }}</strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex justify-content-between mt-n5">
                                <label
                                    class="font-size-h6 font-weight-bolder text-dark pt-5">@lang('admin/dashboard.password')</label>
                            </div>
                            <input
                                class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0  {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                type="password" value="{{ old('password')}}" name="password" autocomplete="off"/>
                            <div class="invalid-feedback" style="padding-right: 0">
                                <strong>{{ $errors->has('password') ? $errors->first('password') : '' }}</strong></div>

                        </div>

                        <div class="pb-lg-0 pb-5">
                            <button type="submit"
                                    class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 add_loading">@lang('admin/dashboard.sign_in')
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="login-aside order-1 order-lg-2 bgi-no-repeat bgi-position-x-right">
            <div class="login-conteiner bgi-no-repeat bgi-position-x-right bgi-position-y-bottom"
                 style="background-image: url({{asset('dashboard_assets/media/svg/illustrations/copy.svg')}});">
                <h3 class="pt-lg-40 pl-lg-20 pb-lg-0 pl-10 py-20 m-0 d-flex justify-content-lg-start font-weight-boldest display5 display1-lg text-white">

                </h3>
            </div>
        </div>
    </div>
@endsection

