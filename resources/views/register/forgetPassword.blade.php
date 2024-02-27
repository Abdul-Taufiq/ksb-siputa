@include('partial.header')
@yield('header')



<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
        <img src="{{ asset('img/logo ksb.png') }}" alt="icon" style="width: 300px">
    </div>
    <div class="card-body">
      <p class="login-box-msg">Masukan email yang terdaftar untuk melanjutkan proses reset password.</p>

      @if (Session::has('message'))
      <div class="alert alert-success" role="alert">
          {{ Session::get('message') }}
      </div>
      @endif

      <form action="{{ route('forget.password.post') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" 
            placeholder="Email" id="email_address" name="email" aria-describedby="emailHelp" required>
            
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="/login">Login</a>
      </p>
    </div>
    <div class="card card-outline card-danger"></div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


@yield('footer')
@include('partial.footer')
