{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Profile')
@section('content')
<section class="content">

    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle admin_picture" src="{{ $datausers->picture }}" alt="User profile picture admin_picture">

            <h3 class="profile-username text-center">{{ $datausers->name }}</h3>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#person_information" data-toggle="tab" aria-expanded="false">Person Informasi</a></li>

          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="person_information">
                <form class="form-horizontal" method="POST" action="#" id="AdminInfoForm">
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" placeholder="Name"
                            value="{{$datausers->name  }}" name="name" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email"
                            value="{{ $datausers->email }}" name="email" disabled>
                    </div>
                </div>
            </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
@endsection
