{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Settings')
@section('content')
<div class="row">
    <div class="col-md-5">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Bordered Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody>
                    <form class="form-horizontal" method="POST" action="{{ route('settings.store') }}"
                    id="AdminInfoForm">
                    {{ csrf_field() }}
                    {{-- {{ dd($setting) }} --}}
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Entry First Name ..."
                            value="" name="short_name">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Entry Last Name ..."
                             value="" name="full_name">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-6 col-form-label">Copyrights</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail" placeholder="Entry Copyright ..."
                                value="" name="copyright">
                            <span class="text-danger error-text email_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Simpan Data</button>
                        </div>
                    </div>
                {{-- </form> --}}
                </tbody>
            </table>
        </div>
      </div>
      <!-- /.box -->
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-7">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Simple Full Width Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <table class="table">
            <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>First Name</th>
                    <th>Copyright Name</th>
                    <th>Action</th>
                </tr>
                <?php $no=1;?>
                @foreach ($datas as $item)
                <tr>
                    <td>{{$no}}</td>
                    <td>
                        <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                    </td>
                    <td><span class="badge bg-red">55%</span></td>
                    <td>
                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php $no++; ?>
                @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
@endsection
