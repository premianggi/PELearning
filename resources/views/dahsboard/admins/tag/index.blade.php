{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Dashboard')
@section('content')

<div class="row">
    <div class="col-md-4">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Tag </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody>
                    @foreach ($tags as $tag)
                    <ul class="list-group">
                        <a href="{{ route('tag.show', $tag->slug) }}">
                            @if ($tag->forums->count()==0)
                            <li class="list-group-item  btn-warning">{{ $tag->name }} <span class="badge">{{ $tag->forums->count() }}</span></li>
                            @else
                            <li class="list-group-item  btn-success">{{ $tag->name }} <span class="badge">{{ $tag->forums->count() }}</span></li>
                            @endif
                        </a>
                      </ul>
                      @endforeach
                </tbody>
            </table>
        </div>
      </div>
      <!-- /.box -->

      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-8">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody>
                  @include('dahsboard.admins.layouts.popular')
              </tbody>
            </table>
          </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
@endsection
