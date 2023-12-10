<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Vaname | @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Favicons -->
    {{-- <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}"> --}}

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    {{-- <link rel="manifest" href="{{ asset('favicons/manifest.json') }}"> --}}
    <meta name="msapplication-TileColor" content="#ffffff">
    {{-- <meta name="msapplication-TileImage" content="{{ asset('favicons//ms-icon-144x144.png') }}"> --}}

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/FontAwesome/6.2.1/css/all.min.css') }}">
    <!-- Sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/adminLTE/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/adminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/adminLTE/dist/css/adminlte.min.css') }}">
    <!-- Our style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            {{-- <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/img/profile/' . Auth::user()->avatar) }}"
                            class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline">
                            {{ Auth::user()->name }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('assets/img/profile/' . Auth::user()->avatar) }}"
                                class="img-circle elevation-2" alt="User Image">
                            <p> {{ Auth::user()->name }}<small>Test</small></p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer text-center">
                            <a class="btn btn-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul> --}}
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar main-sidebar-custom sidebar-dark-orange elevation-4 bg-dark">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link logo-switch">
                <img src="{{ asset('assets/logo/kraf-ico.png') }}" alt="Kraf_logo"
                    class="brand-image-xl logo-xs text-sm">
                <img src="{{ asset('assets/logo/logo-light.png') }}" alt="Kraf_logo"
                    class="brand-image-xs logo-xl text-sm" style="left: 14px">
            </a>

            <!-- Sidebar -->
            <div class="sidebar text-sm">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('assets/img/profile/' . Auth::user()->avatar) }}"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('profile.edit') }}" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-3">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent nav-collapse-hide-child"
                        data-widget="treeview" role="menu" data-accordion="false">
                        @hasanyrole('super admin|admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header mt-3">
                                Administrasi
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('owner.index') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-user"></i>
                                    <p>
                                        Data Owner
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tambak.admin') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-location-dot"></i>
                                    <p>
                                        Data Tambak
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa-solid fa-database"></i>
                                    <p>
                                        Data Master
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('satuan.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Satuan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('kategori.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kategori</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endhasanyrole
                        @hasrole('owner')
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-chart-simple"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            @if (auth()->user()->tambak->count() != null)
                                <li class="nav-header mt-3">
                                    Data
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa-solid fa-id-card"></i>
                                        <p>
                                            Karyawan
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('operator.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Operator</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('tambak.owner') }}" class="nav-link">
                                        <i class="nav-icon fa-solid fa-shrimp"></i>
                                        <p>Tambak</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa-solid fa-users-viewfinder"></i>
                                        <p>Finance</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa-solid fa-magnifying-glass-chart"></i>
                                        <p>
                                            Data
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Panen</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Kematian Udang</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Harga</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endhasrole
                        @hasrole('akuntan')
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-chart-simple"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            @if (auth()->user()->tambak->count() != null)
                                <li class="nav-header mt-3">
                                    Finance
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa-solid fa-shrimp"></i>
                                        <p>
                                            Data
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('pakan.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Harga</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endhasrole
                        @hasrole('operator')
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-chart-simple"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            @if (auth()->user()->tambak->count() != null)
                                <li class="nav-header mt-3">
                                    Operasional
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa-solid fa-shrimp"></i>
                                        <p>
                                            Kolam
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('pakan.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Data Cek Anco</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('pakan.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Data Pakan</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('barang.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Data Sampling</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Data Tebar Bibit</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa-solid fa-magnifying-glass-chart"></i>
                                        <p>
                                            Data
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Panen</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Kematian Udang</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('customer.index') }}" class="nav-link">
                                        <i class="nav-icon fa-solid fa-users-viewfinder"></i>
                                        <p>Customer </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('supplier.index') }}" class="nav-link">
                                        <i class="nav-icon fa-solid fa-truck"></i>
                                        <p>Supplier</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa-solid fa-warehouse"></i>
                                        <p>
                                            Penyimpanan
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('gudang.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Data Gudang</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('barang.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Data Barang</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Transaksi Stok</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endhasrole
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <div class="sidebar-custom">
                <a class="btn btn-danger rounded-tambak" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-power-off"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <button class="btn btn-dark hide-on-collapse pos-right" id="install" hidden>Install</button>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer text-sm">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                The Best Shrimp Farm
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2023 <a style="color: #F15D4B" href="https://madebykraf.com">Vaname</a>.</strong>
            All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('assets/adminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/adminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('assets/adminLTE/plugins/toastr/toastr.min.js') }}"></script>


    @stack('scripts')

    <!-- AdminLTE App -->
    <script src="{{ asset('assets/adminLTE/dist/js/adminlte.min.js') }}"></script>

    <!-- Service Worker -->
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>

    <script>
        let installPrompt = null;
        const installButton = document.querySelector("#install");

        window.addEventListener("beforeinstallprompt", (event) => {
            event.preventDefault();
            installPrompt = event;
            installButton.removeAttribute("hidden");
        });

        installButton.addEventListener("click", async () => {
            if (!installPrompt) {
                return;
            }
            const result = await installPrompt.prompt();
            console.log(`Install prompt was: ${result.outcome}`);
            disableInAppInstallPrompt();
        });

        function disableInAppInstallPrompt() {
            installPrompt = null;
            installButton.setAttribute("hidden", "");
        }

        window.addEventListener("appinstalled", () => {
            disableInAppInstallPrompt();
        });

        function disableInAppInstallPrompt() {
            installPrompt = null;
            installButton.setAttribute("hidden", "");
        }
    </script>

    <script>
        /*** add active class and stay opened when selected ***/
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.nav-sidebar a').filter(function() {
            if (this.href) {
                return this.href == url || url.href.indexOf(this.href) == 0;
            }
        }).addClass('active');

        // for the treeview
        $('ul.nav-treeview a').filter(function() {
            if (this.href) {
                return this.href == url || url.href.indexOf(this.href) == 0;
            }
        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    </script>

    <!-- Sweetalert2 -->
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true
        })

        @if (session('pesan'))
            @switch(session('level-alert'))
                @case('alert-success')
                Toast.fire({
                    icon: 'success',
                    title: '{{ Session::get('pesan') }}'
                })
                @break

                @case('alert-danger')
                Toast.fire({
                    icon: 'error',
                    title: '{{ Session::get('pesan') }}'
                })
                @break

                @case('alert-warning')
                Toast.fire({
                    icon: 'warning',
                    title: '{{ Session::get('pesan') }}'
                })
                @break

                @case('alert-question')
                Toast.fire({
                    icon: 'question',
                    title: '{{ Session::get('pesan') }}'
                })
                @break

                @default
                Toast.fire({
                    icon: 'info',
                    title: '{{ Session::get('pesan') }}'
                })
            @endswitch
        @endif
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'error',
                    title: '{{ $error }}'
                })
            @endforeach
        @endif
    </script>
</body>

</html>
