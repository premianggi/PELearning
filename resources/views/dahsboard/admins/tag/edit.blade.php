{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Dashboard')
@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Data Tag </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tbody>
                <tr>
                    <form role="form" method="post" action="{{ route('tag.update', $tag->id) }}" enctype= multipart/form-data>
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="box-body">
                          <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="name" class="form-control" id="title" value="{{ $tag->name }}" placeholder="Enter Title">
                          </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                </tr>
          </tbody></table>
        </div>
      </div>
      <!-- /.box -->

      <!-- /.box -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
  </div>
@endsection
