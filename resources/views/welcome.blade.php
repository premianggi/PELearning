
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Learning</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="/" class="navbar-brand"><b>E-</b>Learning</a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                          <!-- Notifications Menu -->
                <li>
                    <a href="{{ route('login') }}">
                        <i class="fa fa-sign-in"></i>
                            <span class="label label-warning"></span>Login
                    </a>
                    </li>
                    <!-- Notifications Menu -->
                <li>
                    <a href="{{ route('register') }}">
                        <i class="fa fa-registered"></i>
                            <span class="label label-warning"></span>Register
                    </a>
                </li>
            </ul>
          </div>

        </div>
      </div>

    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
        <div class="box box-default">
            <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                        <div class="box box-solid">
                          <div class="box-body">
                              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                  <ol class="carousel-indicators">
                                      <li data-target="#carousel-example-generic" data-slide-to="0" class="">
                                      </li>
                                      <li data-target="#carousel-example-generic" data-slide-to="1" class="">
                                      </li>
                                      <li data-target="#carousel-example-generic" data-slide-to="2"
                                          class="active"></li>
                                  </ol>
                                  <div class="carousel-inner">
                                      @php $i=1; @endphp
                                      {{-- {{ dd($sliders) }} --}}
                                      @foreach ($sliders as $slider)
                                          <div class="item {{ $i == '1' ? 'active' : '' }}">
                                              @php $i++; @endphp
                                              <img class="img-responsive"
                                                  src="{{ asset('/uploads/slider/' . $slider->image) }}"
                                                  alt="Second slide">
                                          </div>
                                      @endforeach
                                  </div>
                                  <a class="left carousel-control" href="#carousel-example-generic"
                                      data-slide="prev">
                                      <span class="fa fa-angle-left"></span>
                                  </a>
                                  <a class="right carousel-control" href="#carousel-example-generic"
                                      data-slide="next">
                                      <span class="fa fa-angle-right"></span>
                                  </a>
                              </div>
                          </div>
                        </div>
                      <!-- /.box -->
                    </div>
                    {{-- <div class="col-md-6">
                        <label><code>"Jika kamu tidak mengejar apa yang kamu inginkan, maka kamu tidak akan mendapatkannya. Jika kamu tidak bertanya maka jawabannya adalah tidak. Jika kamu tidak melangkah maju, kamu akan tetap berada di tempat yang sama." (Nora Roberts)</code></label>
                    </div> --}}
                </div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 0.1
      </div>
      <strong>Copyright © {{ date('Y') }} <a href="#">E-Learning</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
