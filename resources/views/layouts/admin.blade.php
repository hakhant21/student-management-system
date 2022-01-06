<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('settings.app_name', 'ကျောင်းသားစီမံခန့်ခွဲမှုစနစ်') }} | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist') }}/css/adminlte.min.css">

  <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=pyidaungsu'>

  <style type="text/css">
    @font-face {
      font-family: 'pyidaungsuregular';
      src: url({{asset('pyidaungsu-webfont.woff2')}}) format('woff2');
           url({{asset('pyidaungsu-webfont.woff')}}) format('woff');
      font-weight: normal;
      font-style: normal;
    }
  </style>
  @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
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

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
        </a>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('dist') }}/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('settings.app_name', 'ကျောင်းသားစီမံခန့်ခွဲမှုစနစ်') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist') }}/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-header">ကနဦးအချက်အလက်</li>
          <li class="nav-item">
            <a href="{{ route('admin.settings') }}" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                ဆက်တင်များ
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                စာစစ်ဌာန
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.examination_departments.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>စာရင်း</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.examination_departments.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>အသစ်ဖန်တီးရန်</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                ဘာသာရပ်
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.subjects.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>စာရင်း</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.subjects.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>အသစ်ဖန်တီးရန်</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                ဘာသာတွဲ
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.studies.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>စာရင်း</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.studies.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>အသစ်ဖန်တီးရန်</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>
                ဓာတ်ပုံအမျိုးအစား
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.image_types.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>စာရင်း</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.image_types.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>အသစ်ဖန်တီးရန်</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">လုပ်ဆောင်ချက်အချက်အလက်</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book-reader"></i>
              <p>
                လျှောက်လွှာများ
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.entrance_applications.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>စာရင်း</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
              <p>
                စာရင်းသွင်းခြင်းများ
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.enrollments.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>စာရင်း</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                ကျောင်းသား/သူများ
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>စာရင်း</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope-open-text"></i>
              <p>
                အကြံပြုချက်အမျိုးအစား
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.recommendation_types.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>စာရင်း</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.recommendation_types.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>အသစ်ဖန်တီးရန်</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                ငွေစာရင်းတောင်းခံခြင်း
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.invoices.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>စာရင်း</p>
                    </a>
                </li>

              <li class="nav-item">
                <a href="{{ route('admin.invoices.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>အသစ်ဖန်တီးရန်</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                ငွေတောင်းခံလွှာအမျိုးအစား
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.invoice_types.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>စာရင်း</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.invoice_types.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>အသစ်ဖန်တီးရန်</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-exchange-alt"></i>
              <p>
                မေဂျာပြောင်းလဲခြင်း
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ route('admin.major_change_histories.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>စာရင်း</p>
                  </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.major_change_histories.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>အသစ်ဖန်တီးရန်</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                ပွဲများ
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ route('admin.events.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>စာရင်း</p>
                  </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.events.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>အသစ်ဖန်တီးရန်</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>@yield('title')</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      @if (!empty(session('success')))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0-rc
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="#">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins') }}/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="{{ asset('plugins') }}/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist') }}/js/adminlte.min.js"></script>

<script type="text/javascript">
  $('.delete-btn').click(function (event) {
    event.preventDefault();
    if (confirm('သင်ဖျက်ဖို့သေချာလား?')) {
      document.getElementById($(this).attr('data-form-id')).submit();
    }
  });
</script>

@stack('scripts')


</body>
</html>
