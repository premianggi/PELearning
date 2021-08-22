{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Settings')
@section('sub-title', 'Add Data LKPD')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            @foreach ($datalkpd as $item)
            <div class="box-header with-border">
                <h4>{!! $item->assignment_name !!}</h4>
              </div>
            <div class="box-body">
                    <p>{!! $item->description !!}</p>
                @endforeach
            </div>
            <div class="box-footer with-border">
                <a href="{{ route('datalkpd.index') }}" class="btn btn-danger btn-sm">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
