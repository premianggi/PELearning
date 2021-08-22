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
    <form class="form-horizontal" method="POST" action="{{ route('datausers.store') }}">
        @csrf
      <div class="box-body">
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Name</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama Lengkap">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email">
          </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>

            <div class="col-sm-10">
              <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <label for="password-confirm" class="col-sm-2 control-label">Password Confirm</label>
            <div class="col-sm-10">
              <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
            </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
          <a href="{{ route('datausers.index') }}" class="btn btn-danger btn-sm">Back</a>
        <button type="submit" class="btn btn-success btn-sm pull-center">Register</button>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
@endsection
