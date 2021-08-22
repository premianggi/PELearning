
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>E-Learning</title>
  <base href="{{ \URL::to('/') }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        @stack('styles')
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue layout-boxed ">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ route('admin.dashboard') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E</b>Learning</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>E</b>Learning</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i> Notification
              <span class="label label-warning">{{ count(auth()->user()->unreadNotifications) }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    @foreach (auth()->user()->unreadNotifications as $notification)
                        @include('dahsboard.admins.layouts.notification.'.snake_case(class_basename($notification->type)))
                    @endforeach
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{ Auth::user()->picture }}" class="user-image admin_picture" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{ Auth::user()->picture }}" class="img-circle admin_picture" alt="User Image">

                <p>
                    {{ Auth::user()->name }}
                  <small>{{ date('Y-m-d H:i:s') }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('admin.profile') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ Auth::user()->picture }}" class="img-circle admin_picture" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
          <hr>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}"><i class="fa fa-dashboard (alias)"></i> <span>Dashboard</span></a></li>
        <li class="treeview">
            <a href="#"><i class="fa fa-newspaper-o"></i> <span>Forum</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{ route('forum.create') }}"> <i class="fa fa-edit"></i> Create Forum</a>
                </li>
                <li>
                  <a href="{{ route('forum.index') }}"> <i class="fa fa-folder"></i>All Forum</a>
                </li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#"><i class="fa fa-book"></i> <span>Data LKPD</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{ route('datalkpd.create') }}"> <i class="fa fa-edit"></i> Create LKPD</a>
                </li>
                <li>
                    <a href="{{ route('datalkpd.index') }}"> <i class="fa fa-folder"></i>All Data LKPD</a>
                </li>
            </ul>
        </li>

        <li><a href="{{ route('tag.create') }}" class="nav-link {{ request()->is('admin/tas*') ? 'active' : '' }}"><i class="fa fa-tags"></i> <span>Data Tags</span></a></li>
        <hr>
        <li class="treeview">
            <a href="#"><i class="fa fa-users"></i> <span>Data Users</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{ route('datausers.create') }}"> <i class="fa fa-edit"></i> Create User</a>
                </li>
                <li>
                  <a href="{{ route('datausers.index') }}"> <i class="fa fa-folder"></i>All Data User</a>
                </li>
            </ul>
        </li>
        {{-- <li><a href="{{ route('datausers.index') }}" class="nav-link {{ request()->is('admin/datausers*') ? 'active' : '' }}"><i class="fa fa-users"></i> <span>Data Users</span></a></li> --}}
        {{-- <li><a href="{{ route('admin.profile') }}" class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}"><i class="fa fa-user"></i> <span>Profile</span></a></li> --}}
        <li><a href="{{ route('sliders.index') }}" class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}"><i class="fa fa-sliders"></i> <span>Slider</span></a></li>
        <li><a href="{{ route('admin.settings') }}" class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}"><i class="fa fa-cogs"></i> <span>Settings</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    {{-- <section class="content-header">
        <div class="box box-default">
            <div class="box-header with-border">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">UI</a></li>
                <li class="active">General</li>
              </ol>
            </div>
        </div>
      </section> --}}

    <!-- Main content -->
    <section class="content container-fluid">
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        <b>Version</b> 0.1
    </div>
    <!-- Default to the left -->
    <strong>Copyright © {{ date('Y') }} <a href="#">E-Learning</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/profile.js') }}"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
     @stack('js')
     {{-- ('js') --}}
     @yield('js')

<script>
                $(function() {
                            /*UPDATE ADMIN PERSONAL INFO*/
                            $('#AdminInfoForm').on('submit', function(e) {
                                e.preventDefault();

                                $.ajax({
                                    url: $(this).attr('action'),
                                    method: $(this).attr('method'),
                                    data: new FormData(this),
                                    processData: false,
                                    dataType: 'json',
                                    contentType: false,
                                    beforeSend: function() {
                                        $(document).find('span.error-text').text('');
                                    },
                                    success: function(data) {
                                        if (data.status == 0) {
                                            $.each(data.error, function(prefix, val) {
                                                $('span.' + prefix + '_error').text(val[0]);
                                            });
                                        } else {
                                            $('.admin_name').each(function() {
                                                $(this).html($('#AdminInfoForm').find($(
                                                    'input[name="name"]')).val());
                                            });
                                            alert(data.msg);
                                            /*alert(data.msg);*/
                                        }
                                    }
                                });
                            });

                            $('#changePasswordAdminForm').on('submit', function(e){
                                e.preventDefault();
                                $.ajax({
                                    url:$(this).attr('action'),
                                    method:$(this).attr('method'),
                                    data:new FormData(this),
                                    processData: false,
                                    dataType:'json',
                                    contentType: false,
                                    beforeSend: function(){
                                        $(document).find('span.error-text').text('');
                                    },
                                    success:function(data){
                                        if(data.status==0){
                                            $.each(data.error, function(prefix, val){
                                                $('span.'+ prefix+'_error').text(val[0]);
                                            });
                                        }else{
                                            $('#changePasswordAdminForm')[0].reset();
                                            alert(data.msg);
                                        }
                                    }
                                });
                            });

                            $(document).on('click', '#change_picture_btn', function(){
                                $('#admin_image').click();
                            });

                            $('#admin_image').ijaboCropTool({
                            preview : '.admin_picture',
                            setRatio:1,
                            allowedExtensions: ['jpg', 'jpeg','png'],
                            buttonsText:['CROP','QUIT'],
                            buttonsColor:['#30bf7d','#ee5155', -15],
                            processUrl:'{{ route("adminPictureUpdate") }}',
                            withCSRF:['_token','{{ csrf_token() }}'],
                            onSuccess:function(message, element, status){
                                alert(message);
                            },
                            onError:function(message, element, status){
                                alert(message);
                            }
                        });
                });
</script>

</body>
</html>
