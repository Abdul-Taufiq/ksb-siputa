@include('partial.header')
@yield('header')


<body class="hold-transition register-page">
<div class="register-box">
<div class="card card-outline card-primary">
  <div class="card-header text-center">
    <img src="{{ asset('img/logo ksb lengkap.png') }}" alt="icon" style="width: 300px">
  </div>
  <div class="card-body">
    <h3 class="text-center">Verifikasi Akun Baru!</h3>
    @if (session('resent'))
    <div class="alert alert-success" role="alert">
        {{ __('Link Verifikasi akan dikirimkan ke email anda.') }}
    </div>
    @endif


            <p class="text-center">Sebelum melanjutkan proses, pastikan email anda telah mendapatkan pesan verifikasi di email anda.</p>
            <p class="text-center">Jika anda tidak mendapatkan email verifikasi, silahkan klik link dibawah ini!</p>

            <form class="user" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary btn-user btn-block">{{ __('Kirim verifikasi email') }}</button>
            </form>
        
            
            <hr>


    

  </div>
  <div class="card card-outline card-danger">
  <!-- /.form-box -->
</div><!-- /.card -->
</div>
<!-- /.register-box -->

@yield('footer')
@include('partial.footer')

