{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Settings')
@section('content')
<div class="col-md-9">
    <div class="nav-tabs-custom">
      <div class="tab-content">
        {{-- <div class="tab-pane active" id="person_information"> --}}

            <form class="form-horizontal" method="POST" action="{{ route('adminUpdateInfo') }}"
            id="AdminInfoForm">
            {{ csrf_field() }}
            {{-- {{ dd($query) }} --}}
            <div class="form-group row">
                <label for="inputName" class="col-sm-6 col-form-label">Change Short Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" placeholder="Name"
                    value="" name="short_name">
                    <span class="text-danger error-text name_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-6 col-form-label">Change Full Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" placeholder="Name"
                     value="" name="full_name">
                    <span class="text-danger error-text name_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-6 col-form-label">Change Copyrights</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email"
                        value="" name="copyright">
                    <span class="text-danger error-text email_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Simpan Data</button>
                </div>
            </div>
        {{-- </form> --}}
        {{-- </div> --}}
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
@endsection
