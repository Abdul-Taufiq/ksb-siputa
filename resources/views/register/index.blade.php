  @include('partial.header')
  @yield('header')


  <body class="hold-transition register-page">
      <div class="register-box">
          <div class="card card-outline card-primary">
              <div class="card-header text-center">
                  <img src="{{ asset('img/logo ksb.png') }}" alt="icon" style="width: 300px">
              </div>
              <div class="card-body">
                  <p class="login-box-msg">Register akun baru</p>

                  <form method="POST" action="{{ route('register') }}">
                      @csrf
                      <div class="input-group mb-3">
                          <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                              value="{{ old('name') }}" placeholder="Full name" id="name" required
                              autocomplete="name">
                          <div class="input-group-append">
                              <div class="input-group-text">
                                  <span class="fas fa-user"></span>
                              </div>
                          </div>
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>

                      <div class="input-group mb-3">
                          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                              value="{{ old('email') }}" placeholder="Email" id="email" required
                              autocomplete="email">
                          <div class="input-group-append">
                              <div class="input-group-text">
                                  <span class="fas fa-envelope"></span>
                              </div>
                          </div>
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>

                      <div class="input-group mb-3">
                          <input type="password" class="form-control  @error('password') is-invalid @enderror"
                              name="password" required autocomplete="new-password" placeholder="Password"
                              id="password">
                          <div class="input-group-append">
                              <div class="input-group-text">
                                  <span id="lock" class="fas fa-lock" onclick="showPw()"></span>
                              </div>
                          </div>
                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>

                      <div class="input-group mb-3">
                          <input type="password" class="form-control" placeholder="Confirm password"
                              id="password-confirm" name="password_confirmation" required autocomplete="new-password">
                          <div class="input-group-append">
                              <div class="input-group-text">
                                  <span id="lock_confirm" class="fas fa-lock" onclick="showPwConfirm()"></span>
                              </div>
                          </div>
                      </div>

                      <div class="input-group mb-3">
                          <select name="level" id="level" autocomplete="off" required value="{{ old('level') }}"
                              class="form-control @error('level') is-invalid @enderror">
                              <option disabled selected hidden>- Pilih Hak Akses -</option>
                              <option value="Dir Ops" {{ old('level') == 'Dir Ops' ? 'selected' : null }}>Dir Ops
                              </option>
                              <option value="Pembukuan" {{ old('level') == 'Pembukuan' ? 'selected' : null }}>Pembukuan
                              </option>
                              <option value="Admin TSI" {{ old('level') == 'Admin TSI' ? 'selected' : null }}>Admin
                                  TSI</option>
                              <option value="SDM" {{ old('level') == 'SDM' ? 'selected' : null }}>SDM</option>
                              <option value="Pincab" {{ old('level') == 'Pincab' ? 'selected' : null }}>Pincab
                              </option>
                              <option value="KaOps" {{ old('level') == 'KaOps' ? 'selected' : null }}>KaOps</option>
                          </select>
                      </div>
                      <div class="input-group mb-3">
                          <select name="jabatan" id="jabatan" autocomplete="off" required
                              value="{{ old('jabatan') }}" class="form-control @error('jabatan') is-invalid @enderror">
                              <option disabled selected hidden>- Pilih Jabatan -</option>
                              <option value="Direktur Ops" {{ old('jabatan') == 'Direktur Ops' ? 'selected' : null }}>
                                  Direktur Ops
                              </option>
                              <option value="Pembukuan" {{ old('jabatan') == 'Pembukuan' ? 'selected' : null }}>
                                  Pembukuan
                              </option>
                              <option value="Admin TSI" {{ old('jabatan') == 'Admin TSI' ? 'selected' : null }}>Admin
                                  TSI</option>
                              <option value="SDM" {{ old('jabatan') == 'SDM' ? 'selected' : null }}>SDM</option>
                              <option value="Pincab" {{ old('jabatan') == 'Pincab' ? 'selected' : null }}>Pincab
                              </option>
                              <option value="Kasi Ops" {{ old('jabatan') == 'Kasi Ops' ? 'selected' : null }}>Kasi Ops
                              </option>
                              <option value="Kasi Kom" {{ old('jabatan') == 'Kasi Kom' ? 'selected' : null }}>Kasi Kom
                              </option>
                              <option value="Kabid Kom" {{ old('jabatan') == 'Kabid Kom' ? 'selected' : null }}>Kabid
                                  Kom</option>
                              <option value="Kabid Ops" {{ old('jabatan') == 'Kabid Ops' ? 'selected' : null }}>Kabid
                                  Ops</option>
                              <option value="Kabid Rem" {{ old('jabatan') == 'Kabid Rem' ? 'selected' : null }}>Kabid
                                  Rem</option>
                          </select>
                      </div>
                      <div class="input-group mb-3">
                          <select name="cabang" id="cabang" autocomplete="off" value="{{ old('cabang') }}"
                              class="form-control @error('cabang') is-invalid @enderror">
                              <option value="" selected>- Pilih Cabang -</option>
                              @foreach ($cabang as $item)
                                  <option value="{{ $item->id_cabang }}"
                                      {{ old('cabang') == $item->id_cabang ? 'selected' : null }}>{{ $item->cabang }}
                                  </option>
                              @endforeach
                          </select>
                      </div>

                      <div class="row">
                          <div class="col-8">
                              <div class="icheck-primary">
                                  &nbsp;
                                  </label>
                              </div>
                          </div>
                          <!-- /.col -->
                          <div class="col-4">
                              <button type="submit" class="btn btn-primary btn-block">Register</button>
                          </div>
                          <!-- /.col -->
                      </div>
                  </form>



              </div>
              <div class="card card-outline card-danger">
                  <!-- /.form-box -->
              </div><!-- /.card -->
          </div>
          <!-- /.register-box -->



          {{-- Menonaktifkan select option --}}
          <script>
              function showPw() {

                  const select1 = document.getElementById("level");
                  const select2 = document.getElementById("cabang");

                  select1.addEventListener("change", function() {
                      if (this.value === "Admin TSI" || this.value === "Dir Ops" || this.value === "Dir Kom" || this
                          .value === "Area") {
                          select2.setAttribute("disabled", "disabled");
                      } else {
                          select2.removeAttribute("disabled");
                      }
                  });

                  var input = document.getElementById("password");
                  var lock = document.getElementById("lock");
                  if (input.type == "password") {
                      lock.classList.remove("fa-lock");
                      lock.classList.add("fa-unlock");
                      input.type = "text";
                  } else {
                      lock.classList.remove("fa-unlock");
                      lock.classList.add("fa-lock");
                      input.type = "password";
                  }
              }

              function showPwConfirm() {
                  var input = document.getElementById("password-confirm");
                  var lock_confirm = document.getElementById("lock_confirm");
                  if (input.type == "password") {
                      lock_confirm.classList.remove("fa-lock");
                      lock_confirm.classList.add("fa-unlock");
                      input.type = "text"
                  } else {
                      lock_confirm.classList.remove("fa-unlock")
                      lock_confirm.classList.add("fa-lock")
                      input.type = "password"
                  }
              }
          </script>






          @yield('footer')
          @include('partial.footer')
