<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/home" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/contact" class="nav-link">Kontak</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ asset('Juknis/Juknis.pdf') }}" target="_blank" class="nav-link">Jangan Lupa Baca Juknisnya!</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                {{-- <span class="badge badge-danger navbar-badge">3</span> --}}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <h2>Stay Tunned</h2>
                <p>Sedang Kami kembangkan</p>
            </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                @if (auth()->user()->unreadNotifications->count() != 0)
                    <span class="badge badge-danger navbar-badge">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">
                    {{ auth()->user()->unreadNotifications->count() }}
                    Notifications
                </span>
                <div class="dropdown-divider"></div>

                @foreach (auth()->user()->unreadNotifications->take(5) as $notifikasi)
                    <a href="{{ url($notifikasi->data['url'] . '?id=' . $notifikasi->id . '&kode=' . $notifikasi->data['kode_form']) }}"
                        class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i>
                        {{ $notifikasi->data['title'] }} <br>
                        <p style="color: rgb(0, 82, 177)">
                            Kode: {{ $notifikasi->data['kode_form'] }}
                        </p>
                        <span class="float-right text-muted text-sm">
                            {{ $notifikasi->created_at->diffForHumans() }}
                        </span>
                    </a>
                @endforeach

                <a href="/pemberitahuan" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>

        {{-- fullscreen --}}
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle pt-1" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600">{{ Auth::user()->nama }}</span>
                <img class="img-profile rounded-circle"
                    src="{{ asset('file_upload/foto profil/' . (Auth::user() && Auth::user()->gambar ? Auth::user()->gambar : 'user profil.png')) }}"
                    style="width: 35px">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/profile">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"> //standard --}}
                <a class="dropdown-item" href="" id="logout"> {{-- sweatallert  --}}
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->


<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-info">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link bg-info">
        <img src="{{ asset('img/icon_logo.png') }}" alt="Logo" class="brand-image" style="width: 33px;">
        <span class="brand-text font-weight-light" style="letter-spacing: 4px;"> <i><b>Si -
                    PUTa</b><sup style="font-size: 10pt; letter-spacing: 1px;"> (Apl-ccs)</sup></i> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image pl-1">
                <div class="position-relative">
                    <div
                        class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                    </div>
                    <img style="width: 45px;"
                        src="{{ asset('file_upload/foto profil/' . (Auth::user() && Auth::user()->gambar ? Auth::user()->gambar : 'user profil.png')) }}"
                        class="img-circle elevation-2" alt="User Image">
                </div>
            </div>
            <div class="info">
                <a href="/profile" class="d-block">{{ Auth::user()->nama }}</a>
                <span>{{ Auth::user()->jabatan }}</span>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item {{ request()->is('/home') ? 'menu-open' : '' }}">
                    <a href="/home" class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>


                @if (auth()->user()->jabatan != 'Pembukuan')
                    {{-- Email --}}
                    <li
                        class="nav-item {{ request()->is('user-email-reset*', 'user-email-pengajuan*') ? 'active menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link  {{ request()->is('user-email-reset*', 'user-email-pengajuan*') ? 'active aria-expanded= "true"' : 'collapsed' }}">
                            <i class="nav-icon fa-solid fa-envelope-open-text"></i>
                            <p>
                                Email
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul
                            class="nav nav-treeview  {{ request()->is('user-email-reset*', 'user-email-pengajuan*') ? 'style="display: block;"' : '' }}">
                            <li class="nav-item">
                                <a href="/user-email-pengajuan"
                                    class="nav-link {{ Request::is('user-email-pengajuan*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengajuan Email</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/user-email-reset"
                                    class="nav-link {{ Request::is('user-email-reset*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reset Password</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- end Email --}}
                @endif

                {{-- SIADIT --}}
                <li
                    class="nav-item {{ request()->is('user-siadit*', 'siadit-perubahan*') ? 'active menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link  {{ request()->is('user-siadit*', 'siadit-perubahan*') ? 'active aria-expanded= "true"' : 'collapsed' }}">
                        {{-- <i class="nav-icon fa-solid fa-envelope-open-text"></i> --}}
                        <i class="nav-icon fa-regular fa-credit-card"></i>
                        <p>
                            Si-ADiT
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul
                        class="nav nav-treeview  {{ request()->is('user-siadit*', 'siadit-perubahan*') ? 'style="display: block;"' : '' }}">
                        @if (auth()->user()->jabatan != 'Pembukuan')
                            <li class="nav-item">
                                <a href="/user-siadit"
                                    class="nav-link {{ Request::is('user-siadit*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengajuan User</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->jabatan != 'SDM')
                            <li class="nav-item">
                                <a href="/siadit-perubahan"
                                    class="nav-link {{ Request::is('siadit-perubahan*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Revisi Data Kredit</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                {{-- end Email --}}


                @if (auth()->user()->jabatan != 'Pembukuan')
                    {{-- MBS --}}
                    <li
                        class="nav-item {{ request()->is('mso-pengajuan*', 'mso-reset*') ? 'active menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link  {{ request()->is('mso-pengajuan*', 'mso-reset*') ? 'active aria-expanded= "true"' : 'collapsed' }}">
                            <i class="fa fa-id-card nav-icon" aria-hidden="true"></i>
                            <p>
                                MBS
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul
                            class="nav nav-treeview  {{ request()->is('mso-pengajuan*', 'mso-reset*') ? 'style="display: block;"' : '' }}">
                            <li class="nav-item">
                                <a href="/mso-pengajuan"
                                    class="nav-link {{ Request::is('mso-pengajuan*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User MSO</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/mso-reset"
                                    class="nav-link {{ Request::is('mso-reset*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reset Password</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- end MBS --}}
                @endif


                @if (auth()->user()->jabatan != 'Pembukuan')
                    {{-- ecoll --}}
                    <li
                        class="nav-item {{ request()->is('user-ecoll*', 'reset-ecoll*') ? 'active menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link  {{ request()->is('user-ecoll*', 'reset-ecoll*') ? 'active aria-expanded= "true"' : 'collapsed' }}">
                            {{-- <i class="fa fa-id-card nav-icon" aria-hidden="true"></i> --}}
                            <i class="fa fa-address-book nav-icon" aria-hidden="true"></i>
                            <p>
                                User Ecoll
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul
                            class="nav nav-treeview  {{ request()->is('user-ecoll*', 'reset-ecoll*') ? 'style="display: block;"' : '' }}">
                            <li class="nav-item">
                                <a href="/user-ecoll"
                                    class="nav-link {{ Request::is('user-ecoll*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User Ecoll</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/reset-ecoll"
                                    class="nav-link {{ Request::is('reset-ecoll*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reset Password</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- end ecoll --}}


                    {{-- User SLIK --}}
                    <li
                        class="nav-item {{ request()->is('slik-pengajuan*', 'slik-reset*') ? 'active menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link  {{ request()->is('slik-pengajuan*', 'slik-reset*') ? 'active aria-expanded= "true"' : 'collapsed' }}">
                            <i class="fa fa-window-restore nav-icon" aria-hidden="true"></i>
                            <p>
                                User SLIK
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul
                            class="nav nav-treeview  {{ request()->is('slik-pengajuan*', 'slik-reset*') ? 'style="display: block;"' : '' }}">
                            <li class="nav-item">
                                <a href="/slik-pengajuan"
                                    class="nav-link {{ Request::is('slik-pengajuan*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User SLIK</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                            <a href="/slik-reset" class="nav-link {{ Request::is('slik-reset*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reset Password</p>
                            </a>
                        </li> --}}
                        </ul>
                    </li>
                    {{-- end User SLIK --}}


                    {{-- User Pefindo --}}
                    <li
                        class="nav-item {{ request()->is('pefindo-pengajuan*', 'pefindo-reset*') ? 'active menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link  {{ request()->is('pefindo-pengajuan*', 'pefindo-reset*') ? 'active aria-expanded= "true"' : 'collapsed' }}">
                            <i class="fa fa-window-maximize nav-icon" aria-hidden="true"></i>
                            <p>
                                User Pefindo
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul
                            class="nav nav-treeview  {{ request()->is('pefindo-pengajuan*', 'pefindo-reset*') ? 'style="display: block;"' : '' }}">
                            <li class="nav-item">
                                <a href="/pefindo-pengajuan"
                                    class="nav-link {{ Request::is('pefindo-pengajuan*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User Pefindo</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/pefindo-reset"
                                    class="nav-link {{ Request::is('pefindo-reset*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reset Password</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- end User Pefindo --}}
                @endif



                @if (auth()->user()->jabatan != 'SDM')
                    {{-- Pembatalan transaksi --}}
                    <li class="nav-item {{ request()->is('pembatalan*') ? 'active menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link  {{ request()->is('pembatalan*') ? 'active aria-expanded= "true"' : 'collapsed' }}">
                            <i class="fa fa-window-close nav-icon" aria-hidden="true"></i>
                            <p>
                                Pembatalan Transaksi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul
                            class="nav nav-treeview  {{ request()->is('pembatalan*') ? 'style="display: block;"' : '' }}">
                            <li class="nav-item">
                                <a href="/pembatalan-akuntansi"
                                    class="nav-link {{ Request::is('pembatalan-akuntansi*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Akuntansi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/pembatalan-antarbank"
                                    class="nav-link {{ Request::is('pembatalan-antarbank*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Antar Bank</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/pembatalan-antarkantor"
                                    class="nav-link {{ Request::is('pembatalan-antarkantor*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Antar Kantor</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/pembatalan-deposito"
                                    class="nav-link {{ Request::is('pembatalan-deposito*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Deposito</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/pembatalan-ecoll"
                                    class="nav-link {{ Request::is('pembatalan-ecoll*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>E-Collector</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/pembatalan-inventaris"
                                    class="nav-link {{ Request::is('pembatalan-inventaris*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Inventaris</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/pembatalan-kredit"
                                    class="nav-link {{ Request::is('pembatalan-kredit*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kredit</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/pembatalan-tabungan"
                                    class="nav-link {{ Request::is('pembatalan-tabungan*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tabungan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- end Pembatalan transaksi --}}


                    {{-- Perubuhan Transaksi --}}
                    <li class="nav-item {{ request()->is('perubahan*') ? 'active menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link  {{ request()->is('perubahan*') ? 'active aria-expanded= "true"' : 'collapsed' }}">
                            <i class="fa fa-edit nav-icon" aria-hidden="true"></i>
                            <p>
                                Perubahan Transaksi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul
                            class="nav nav-treeview  {{ request()->is('perubahan*') ? 'style="display: block;"' : '' }}">
                            <li class="nav-item">
                                <a href="/perubahan-cif"
                                    class="nav-link {{ Request::is('perubahan-cif*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Update CIF</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/perubahan-deposito"
                                    class="nav-link {{ Request::is('perubahan-deposito*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master Deposito</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/perubahan-kredit"
                                    class="nav-link {{ Request::is('perubahan-kredit*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master Kredit</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- End Perubahan Transaksi --}}
                @endif

                {{-- Log Activity --}}
                <li class="nav-item {{ request()->is('log-activity*') ? 'menu-open' : '' }}">
                    <a href="/log-activity" class="nav-link {{ Request::is('log-activity*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-history"></i>
                        <p>
                            Log Activity
                        </p>
                    </a>
                </li>
                {{-- End Log Activity --}}

            </ul>
        </nav>
    </div>
</aside>
