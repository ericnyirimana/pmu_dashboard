@extends('layouts.auth')

@section('content')
<!-- HOME -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="wrapper-page">

                    <div class="account-pages">
                        <div class="account-box">
                            <div class="account-logo-box">
                                <h2 class="text-uppercase text-center">
                                    <a href="/" class="text-success">
                                        <span><img class="logo" width="141px" height="54px" src="{{ asset("/img/pmu_logo.png")}}"/></span>
                                    </a>
                                </h2>
                                <h5 class="text-uppercase font-bold m-b-5 m-t-50">{{ ucfirst(trans('labels.forgot_your_password')) }}</h5>
                                <p class="m-b-0">{{ ucfirst(trans('labels.email_to_reset')) }}</p>
                            </div>
                            <div class="account-content">
                              <form class="form-horizontal" method="POST" action="{{ route('send.reset.link') }}">
                                  @csrf
                                    <div class="form-group m-b-20 row">
                                        <div class="col-12">
                                            @error('login')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                            @if (session('message') )
                                                <div class="alert alert-success">
                                                    {{ session('message') }}
                                                </div>
                                            @endif
                                            <label for="emailaddress" style="font-family: 'Nunito Sans'">Email address</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row text-center m-t-10">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-md btn-block btn-primary waves-effect waves-light" style="background-color: #0f218b !important; border-color: #0f218b !important;">
                                                Submit
                                            </button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                      </div>
                  </div>
                  <!-- end card-box-->


              </div>
              <!-- end wrapper -->

          </div>
      </div>
  </div>
</section>
  <!-- END HOME -->
  @endsection
