{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Halaman Forum')
@section('name')
@section('box-title', 'Membuat Forum')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Form Register New Account</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" method="POST" action="{{ route('adminUpdateInfo') }}"
    id="AdminInfoForm">
    {{ csrf_field() }}
    {{-- {{ dd($query) }} --}}
    <div class="form-group row">
        <label for="inputName" class="col-sm-6 col-form-label">Change Short Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" placeholder="Name"
            value="{{ $setting->short_name }}" name="short_name">
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
</form>
  </div>
@endsection
