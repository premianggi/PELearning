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
            <img class="profile-user-img img-responsive img-circle admin_picture" src="{{ Auth::user()->picture }}" alt="User profile picture admin_picture">

            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

            <p class="text-muted text-center">Software Engineer</p>

            <input type="file" name="admin_image" id="admin_image" style="opacity:0; height:1px; none">
            <a href="javascript:void(0)" class="btn btn-primary btn-block" id="change_picture_btn"><b>Change Picture</b></a>
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
            <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab" aria-expanded="false">Change Password</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="person_information">
                <form class="form-horizontal" method="POST" action="{{ route('adminUpdateInfo') }}"
                id="AdminInfoForm">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" placeholder="Name"
                            value="{{ Auth::user()->name }}" name="name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email"
                            value="{{ Auth::user()->email }}" name="email">
                        <span class="text-danger error-text email_error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Simpan Data</button>
                    </div>
                </div>
            </form>
            </div>

            <div class="tab-pane" id="change_password">
                <form class="form-horizontal" id="changePasswordAdminForm" action="{{ route('adminChangePassword') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="oldPassword" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="oldpassword" class="form-control" id="old_password"
                                placeholder="Enter current password">
                                <span class="text-danger error-text oldpassword_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newPassword" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="newpassword" class="form-control" id="new_password"
                                placeholder="Enter new password">
                                <span class="text-danger error-text newpassword_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confirmNewPassword" class="col-sm-2 col-form-label">Confirm New
                            Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="cnewpassword" class="form-control" id="confirm_password"
                                placeholder="ReEnter new password">
                                <span class="text-danger error-text cnewpassword_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Change Password</button>
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
