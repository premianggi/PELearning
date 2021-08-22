{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.users.layouts.userdash')

@section('title', 'Dashboard')
@section('content')
<div class="col-md-6">

    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Tag </h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tbody>
                    @foreach ($showTag as $tag)
                    <ul class="list-group">
                        <a href="{{ route('tag.show', $tag->slug) }}">
                            @if ($tag->forums->count()==0)
                            <li class="list-group-item  btn-danger">{{ $tag->name }} <span class="badge">{{ $tag->forums->count() }}</span></li>
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
</div>
@endsection
