<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">


    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

    <!-- jQuery (Load before FullCalendar) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.min.js"></script>



    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js') }}"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--aworking link right here-->

    <!-- Bootstrap (optional for layout) -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.css" rel="stylesheet">
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.js') }}"></script>

    <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/chart.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('asset/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet"
        href="{{ asset('asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }} ">

    <link rel="stylesheet" href="{{ asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }} ">

    <link rel="stylesheet" href="{{ asset('asset/plugins/jqvmap/jqvmap.min.css') }} ">

    <link rel="stylesheet" href="{{ asset('asset/dist/css/adminlte.min.css?v=3.2.0') }}">

    <link rel="stylesheet" href="{{ asset('asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }} ">

    <link rel="stylesheet" href="{{ asset('asset/plugins/daterangepicker/daterangepicker.css') }} ">

    <link rel="stylesheet" href="{{ asset('asset/plugins/summernote/summernote-bs4.min.css') }} ">

</head>

<body>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
                <div class="os-scrollbar-track">
                    <div class="os-scrollbar-handle" style="height: 44.9208%; transform: translate(0px, 0px);"></div>
                </div>
            </div>

            <nav class="main-header navbar navbar-expand navbar-light navbar-light elevation-1">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- User's Profile Picture -->
                            <img src="{{ asset('https://th.bing.com/th/id/OIP.B7lY1GPxjghWzpDx389HggHaHa?rs=1&pid=ImgDetMain') }}"
                                alt="Profile" class="rounded-circle" style="opacity: .8; width: 35px; height: 35px;">
                            <!-- Display User's Name -->
                            <span class="d-none d-md-block dropdown-toggle ps-2">
                                {{ Auth::user()->name ?? 'Guest' }} <!-- Fetch logged-in user's name -->
                            </span>
                        </a><!-- End Profile Image Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>{{ Auth::user()->name ?? 'Guest' }}</h6> <!-- User's name -->
                                <span>
                                    @if (Auth::user() && Auth::user()->usertype == 'admin')
                                        Admin
                                    @else
                                        User
                                    @endif
                                </span>

                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="bi bi-gear"></i>
                                    <span>Account Settings</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="bi bi-question-circle"></i>
                                    <span>Need Help?</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> {{ __('Sign Out') }}
                                    </x-dropdown-link>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </nav>

            <aside class="main-sidebar sidebar-gray-primary bg-light elevation-1">

                <div style="display: flex; justify-content: center; align-items: center;">
                    <a href="#">
                        <img src="{{ asset('images/JVD-removebg-preview.png') }}" alt="JVD Logo"
                            class="brand-image elevation-0" style="opacity: .8; width: 100px; height: 70px;">
                    </a>
                </div>


                <div class="sidebar">
                    <div class="container" style="font-family: sans-serif; font-size: large;">
                        <nav class="mt-1">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">

                                @can('view dashboard')
                                    <li class="nav-item">
                                        <a href="{{ route('dashboard') }}" class="nav-link bg-light">
                                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                            <p>Dashboard</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('view userdashboard')
                                    <li class="nav-item">
                                        <a href="{{ route('dashboard') }}" class="nav-link bg-light">
                                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                            <p>Dashboard</p>
                                        </a>
                                    </li>
                                @endcan

                                <li class="nav-item menu">
                                    @can('view vendor portal')
                                        <a href="#" class="nav-link bg-light">
                                            <i class="nav-icon fas fa-th"></i>
                                            <p>
                                                Vendor Portal
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>

                                        <ul class="nav nav-treeview">
                                            @can('view vendors')
                                                <li class="nav-item">
                                                    <a href="{{ route('vendor.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-teal"></i>
                                                        <p>Vendor List</p>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>

                                        <ul class="nav nav-treeview">
                                            @can('view auctions')
                                                <li class="nav-item">
                                                    <a href="{{ route('auction.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-pink"></i>
                                                        <p>Auction</p>
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('view bids')
                                                <li class="nav-item">
                                                    <a href="{{ route('bid.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-pink"></i>
                                                        <p>Bid</p>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>

                                        <ul class="nav nav-treeview">
                                            @can('view suppliers')
                                                <li class="nav-item">
                                                    <a href="{{ route('supplier.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-info"></i>
                                                        <p>Supplier</p>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>

                                        <ul class="nav nav-treeview">
                                            @can('view subcontractors')
                                                <li class="nav-item">
                                                    <a href="{{ route('subcontractor.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-primary"></i>
                                                        <p>Subcontractor</p>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    @endcan

                                </li>

                                @can('view audit management')
                                    <li class="nav-item menu">
                                        <a href="#" class="nav-link bg-light">
                                            <i class="nav-icon fas fa-chart-pie"></i>
                                            <p>
                                                Audit Management
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            @can('view audit supply')
                                                <li class="nav-item">
                                                    <a href="{{ route('supply.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-teal"></i>
                                                        <p>Audit Supply</p>
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('view supply report')
                                                <li class="nav-item">
                                                    <a href="{{ route('supplyreport.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-teal"></i>
                                                        <p>Supply Report</p>
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('view audit asset')
                                                <li class="nav-item">
                                                    <a href="{{ route('assets.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-pink"></i>
                                                        <p>Audit Asset</p>
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('view asset report')
                                                <li class="nav-item">
                                                    <a href="{{ route('assetreport.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-info"></i>
                                                        <p>Asset Report</p>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcan

                                @can('view fleet management')
                                    <li class="nav-item">
                                        <a href="#" class="nav-link bg-light">
                                            <i class="nav-icon fas fa-cogs"></i>
                                            <p>
                                                Fleet Management
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>

                                        <ul class="nav nav-treeview">
                                            @can('view vehicle')
                                                <li class="nav-item">
                                                    <a href="{{ route('vehicle.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-teal"></i>
                                                        <p>Vehicle</p>
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('view tracking')
                                                <li class="nav-item">
                                                    <a href="{{ route('map') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-teal"></i>
                                                        <p>Tracking</p>
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('manage details')
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link bg-light">
                                                        <i class="fas fa-folder"></i>
                                                        <p>
                                                            Manage Details
                                                            <i class="fas fa-angle-left right"></i>
                                                        </p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        @can('view driver')
                                                            <li class="nav-item">
                                                                <a href="{{ route('driver.index') }}" class="nav-link bg-light">
                                                                    <i class="far fa-circle text-pink"></i>
                                                                    <p>Driver</p>
                                                                </a>
                                                            </li>
                                                        @endcan

                                                        @can('view maintenance')
                                                            <li class="nav-item">
                                                                <a href="{{ route('maintenance.index') }}"
                                                                    class="nav-link bg-light">
                                                                    <i class="far fa-circle text-pink"></i>
                                                                    <p>Maintenance</p>
                                                                </a>
                                                            </li>
                                                        @endcan

                                                        @can('view fuel records')
                                                            <li class="nav-item">
                                                                <a href="{{ route('fuel.index') }}" class="nav-link bg-light">
                                                                    <i class="far fa-circle text-pink"></i>
                                                                    <p>Fuel Records</p>
                                                                </a>
                                                            </li>
                                                        @endcan

                                                        @can('view trip details')
                                                            <li class="nav-item">
                                                                <a href="{{ route('trip.index') }}" class="nav-link bg-light">
                                                                    <i class="far fa-circle text-pink"></i>
                                                                    <p>Trip Details</p>
                                                                </a>
                                                            </li>
                                                        @endcan
                                                    </ul>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcan

                                @can('view vehicle reservation')
                                    <li class="nav-item">
                                        <a href="#" class="nav-link bg-light">
                                            <i class="nav-icon fas fa-bus"></i>
                                            <p>
                                                Vehicle Reservation
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>

                                        <ul class="nav nav-treeview">
                                            @can('view reservation list')
                                                <li class="nav-item">
                                                    <a href="{{ route('reservation.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-teal"></i>
                                                        <p>Vehicle Reservation List</p>
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('view vehicle release')
                                                <li class="nav-item">
                                                    <a href="{{ route('release.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-pink"></i>
                                                        <p>Vehicle Release</p>
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('view reservation history')
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link bg-light">
                                                        <i class="far fa-circle text-info"></i>
                                                        <p>History</p>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcan

                                @can('view document tracking')
                                    <li class="nav-item">
                                        <a href="#" class="nav-link bg-light">
                                            <i class="nav-icon fas fa-folder-open"></i>
                                            <p>
                                                Document Tracking
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>

                                        <ul class="nav nav-treeview">
                                            @can('view document submission')
                                                <li class="nav-item">
                                                    <a href="{{ route('document.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-teal"></i>
                                                        <p>Document Submission</p>
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('view document request')
                                                <li class="nav-item">
                                                    <a href="{{ route('request.index') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-teal"></i>
                                                        <p>Document Request</p>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcan


                                @can('view email')
                                    <li class="nav-item">
                                        <a href="#" class="nav-link bg-light">
                                            <i class="nav-icon fas fa-inbox"></i>
                                            <p>
                                                Email
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            @can('view inbox')
                                                <li class="nav-item">
                                                    <a href="{{ route('inbox') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-teal"></i>
                                                        <p>Inbox</p>
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('compose email')
                                                <li class="nav-item">
                                                    <a href="{{ route('compose') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-pink"></i>
                                                        <p>Compose</p>
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('read email')
                                                <li class="nav-item">
                                                    <a href="{{ route('read') }}" class="nav-link bg-light">
                                                        <i class="far fa-circle text-info"></i>
                                                        <p>Read</p>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcan

                                @can('view event calendar')
                                    <li class="nav-item">
                                        {{-- <a href="{{ route('#') }}" class="nav-link bg-light"> --}}
                                        <i class="nav-icon fas fa-calendar"></i>
                                        <p>
                                            Event Calendar
                                        </p>
                                        </a>
                                    </li>
                                @endcan

                                @can('view role')
                                    <li class="nav-item">
                                        <a href="{{ route('roles.index') }}" class="nav-link bg-light">
                                            <i class="nav-icon fas fa-user-cog"></i>
                                            <p>
                                                User Permission
                                            </p>
                                        </a>
                                    </li>
                                @endcan


                            </ul>
                    </div>
            </aside>
            <div class="content-wrapper">

                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0"></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#"></a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="content">

                    @yield('content')
                </section>
            </div>
        </div>


        <script src="{{ asset('asset/plugins/jquery/jquery.min.js') }}"></script>

        <script src="{{ asset('asset/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>

        <script src="{{ asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('asset/plugins/chart.js/Chart.min.js') }}"></script>

        <script src="{{ asset('asset/plugins/sparklines/sparkline.js') }}"></script>

        <script src="{{ asset('asset/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('asset/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

        <script src="{{ asset('asset/plugins/moment/moment.min.js') }}"></script>

        <script src="{{ asset('asset/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('asset/plugins/daterangepicker/daterangepicker.js') }}"></script>

        <script src="{{ asset('asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

        <script src="{{ asset('asset/plugins/summernote/summernote-bs4.min.js') }}"></script>

        <script src="{{ asset('asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

        <script src="{{ asset('asset/dist/js/adminlte.js?v=3.2.0') }}"></script>

        {{-- <script src="{{ asset('assets/dist/js/demo.js') }}"></script> --}}

        <script src="{{ asset('asset/dist/js/pages/dashboard.js') }}"></script>

        <script src="{{ asset('asset/dist/js/pages/dashboard2.js') }}"></script>
        <script src="{{ asset('asset/dist/js/pages/dashboard3.js') }}"></script>

        <script src="{{ asset('asset/plugins/fullcalendar/main.js') }}"></script>
        <script src="{{ asset('asset/plugins/moment/moment.min.js') }}"></script>

        <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>

        <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('https://code.jquery.com/ui/1.12.1/jquery-ui.min.js') }}"></script>

    </body>

</html>
