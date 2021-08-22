{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Profile')
@section('content')
  <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#person_information" data-toggle="tab" aria-expanded="false">Person Informasi</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="person_information">
                <form class="form-horizontal" method="POST" action="{{ route('datausers.update', $datausers->id) }}">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" placeholder="Name"
                            value="{{ $datausers->name }}" name="name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email"
                            value="{{ $datausers->email }}" name="email">
                        <span class="text-danger error-text email_error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
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
