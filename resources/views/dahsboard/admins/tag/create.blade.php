{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Dashboard')
@section('content')

<div class="row">
    @if (session('info'))
    <div class="alert alert-success">
        <i class="fa fa-check"></i>{{ session('info') }}</div>
    </div>
    @endif
    <div class="col-md-4">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Buat Tag Baru</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tbody>
                <tr>
                    <form role="form" method="post" action="{{ route('tag.store') }}" enctype= multipart/form-data>
                        {{ csrf_field() }}
                        <div class="box-body">
                          <div class="form-group">
                            <label for="title" lass="col-md-4 col-form-label text-md-right">{{ __('Tag') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" class="form-control" id="title" placeholder="Enter Tag"  required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
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
    <div class="col-md-8">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Tag</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody>
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Aksi</th>
                  </tr>
                  <?php $no=1;?>
                  @foreach ($tags as $tag)
                  <tr>
                      <td>{{ $no }}</td>
                      <td>{{ $tag->name }}</td>
                      <td>{{ $tag->slug }}</td>
                      <td>
                        <form action="{{ route('tag.destroy', $tag->id) }}" method="post" style="margin:0;">
                            {{ csrf_field() }}
                          <a href="{{ route('tag.edit', $tag->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                      </td>
                  </tr>
                  <?php $no++ ;?>
                  @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-right">
                {!! $tags->links() !!}
            </div>
          </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
@endsection
