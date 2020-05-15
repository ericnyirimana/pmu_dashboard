@extends('layouts.auth')

@section('content')
<!-- HOME -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">

                <div class="wrapper-page">
                    <div class="account-pages">
                        <div class="account-box">

                            <div class="account-logo-box">
                                <h2 class="text-uppercase text-center">
                                    <a href="index.html" class="text-success">
                                        <span>@svg('pmu-logo', 'logo')</span>
                                    </a>
                                </h2>
                            </div>

                            <div class="account-content">
                                <h1 class="text-error">{{ __('errors.403_title') }}</h1>
                                <h2 class="text-uppercase text-danger m-t-30">{{ __('errors.403_message') }}</h2>
                                <a class="btn btn-md btn-block btn-primary waves-effect waves-light m-t-20" href="{{
                                route('dashboard.index')

                                }}">
                                    {{ __('button.back_home') }}</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<!-- END HOME -->
@endsection
