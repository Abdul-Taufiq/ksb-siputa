@include('partial.header')
@yield('header')


<body class="hold-transition login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <img src="{{ asset('img/logo ksb lengkap.png') }}" alt="icon" style="width: 300px">
        </div>
        <div class="card-body">
          <p class="login-box-msg">Reset Password Akun!</p>

          @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
          @endif

          <form method="POST" action="{{ route('reset.password.post') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <input type="email" class="form-control form-control-user 
                @error('email') is-invalid @enderror"
                id="email_address" name="email" aria-describedby="emailHelp"
                placeholder="Masukan Email..." required autofocus>

                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="input-group mb-3">
              <input type="password" id="password" name="password" 
                class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
            <div class="input-group mb-3">
              <input type="password" id="password-confirm"  class="form-control" name="password_confirmation" 
              required autocomplete="new-password" placeholder="Confirm Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              @if ($errors->has('password_confirmation'))
                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
              @endif
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Reset password</button>
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