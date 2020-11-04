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
                                    <a href="index.html" class="text-success">
                                        <span><img class="logo" width="141px" height="54px" src="{{ asset("/img/pmu_logo.png")}}"/></span>
                                    </a>
                                </h2>
                                <h5 class="text-uppercase font-bold m-b-5 m-t-50">Sign In</h5>
                                <p class="m-b-0">Login to your Admin account</p>
                            </div>
                            <div class="account-content">
                              <form class="form-horizontal" method="POST" action="{{ route('authenticate') }}">
                                  @csrf
                                    <div class="form-group m-b-20 row">
                                        <div class="col-12">
                                            <label for="emailaddress" style="font-family: 'Nunito Sans'">Email address</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('login')
                                                  <span class="invalid-feedback d-block" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                            @enderror
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-group row m-b-20">
                                        <div class="col-12">
                                            <label for="password" style="font-family: 'Nunito Sans'">Password</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row m-b-20">
                                        <div class="col-12">

                                            <div class="checkbox checkbox-success" style="padding-left: 16px !important;">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label for="remember" style="font-family: 'Nunito Sans'">
                                                    Remember me
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row text-center m-t-10">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-md btn-block btn-primary waves-effect waves-light" style="background-color: #0f218b !important; border-color: #0f218b !important;">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group row text-center m-t-10">
                                        <div class="col-12">
                                            <a href="#" class="text-muted pull-right"><small>Forgot your password?</small></a>
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
