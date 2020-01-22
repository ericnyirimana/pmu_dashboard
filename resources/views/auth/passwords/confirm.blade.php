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
                                        <span>@svg('pmu-logo', 'logo')</span>
                                    </a>
                                </h2>
                                <h5 class="text-uppercase font-bold m-b-5 m-t-50">Set Password</h5>
                                <p class="m-b-0">Set your password account</p>
                            </div>
                            <div class="account-content">
                              <form class="form-horizontal" method="POST" action="{{ route('password.confirm') }}">
                                  @csrf
                                  <div class="form-group row m-b-20">
                                      <div class="col-12">
                                          <label for="password">Password</label>
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
                                            <label for="password">Confirm Password</label>
                                            <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="current-password">

                                            @error('confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row text-center m-t-10">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-md btn-block btn-primary waves-effect waves-light">
                                                {{ __('Confirm') }}
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
