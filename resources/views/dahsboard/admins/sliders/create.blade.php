{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Settings')
@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        {{-- <div class="box box-primary"> --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('sub-title')</h3>

                <div class="box-tools pull-right">
                    <a href="{{ route('sliders.index') }}" class="btn btn-danger btn-sm">Kembali</a>
                </div>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session('success') }}
                </div>
            @endif
            <div class="box-body">
                <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Heading</label>
                        <input type="text" name="heading" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Slider Image Upload</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <input type="checkbox" name="status">0=Visible 1=Hidde
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
