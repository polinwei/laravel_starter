@extends('layouts.auth.index')
@section('content')

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

        <div class="d-flex justify-content-center py-4">
          <a href="{{ route('home') }}" class="logo d-flex align-items-center w-auto">
            <img src="/NiceAdmin/img/logo.png" alt="">
            <span class="d-none d-lg-block">NiceAdmin</span>
          </a>
        </div><!-- End Logo -->

        <div class="card mb-3">

          <div class="card-body">

            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4">Reset Passsword</h5>
              <p class="text-center small">Enter your email to get reset password link</p>
            </div>

            <form action="{{ route('reset.password.post') }}" method="POST" class="row g-3 needs-validation" novalidate>
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">

              <div class="col-12">
                <label for="yourEmail" class="form-label">Email</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend">@</span>
                  <input type="text" placeholder="Email" id="yourEmail" class="form-control" name="email" value="{{ $email }}" required>
                  <div class="invalid-feedback">Please enter your email.</div>
                </div>
              </div>
              @if ($errors->has('email'))
                <div class="row">
                  <div class="text-danger">{{ $errors->first('email') }}</div>
                </div>
              @endif

              <div class="col-12">
                <label for="yourPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="yourPassword" required autofocus>
                <div class="invalid-feedback">Please enter your password!</div>
              </div>
              @if ($errors->has('password'))
                <div class="row">
                  <div class="text-danger">{{ $errors->first('password') }}</div>
                </div>                
              @endif

              <div class="col-12">
                <label for="password-confirm" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password-confirm" required autofocus>
                <div class="invalid-feedback">Please enter your password!</div>
              </div>
              @if ($errors->has('password_confirmation'))
                <div class="row">
                  <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                </div>                
              @endif

              <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                      Reset Password
                  </button>
              </div>
            </form>
          </div>
        </div>

        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>

      </div>
    </div>
  </div>

</section>

@endsection