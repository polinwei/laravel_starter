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
            @if (Session::has('message'))
                  <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif

            <form action="{{ route('forget.password.post') }}" method="POST" class="row g-3 needs-validation" novalidate>
              @csrf
              <div class="col-12">
                <label for="yourEmail" class="form-label">Email</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend">@</span>
                  <input type="text" placeholder="Email" id="yourEmail" class="form-control" name="email" required>
                  <div class="invalid-feedback">Please enter your email.</div>                  
                </div>
              </div>
              @if ($errors->has('email'))
                <div class="row">
                  <div class="text-danger">{{ $errors->first('email') }}</div>
                </div>
              @endif

              <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Send Pssword Reset Link</button>
              </div>
              <div class="col-12">
                <p class="small mb-0">Already have an account? <a href="login">Log in</a></p>
              </div>
              <div class="col-12">
                <p class="small mb-0">Don't have account? <a href="register">Create an account</a></p>
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