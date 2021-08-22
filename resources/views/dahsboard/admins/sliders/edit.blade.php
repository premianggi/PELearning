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
                <form action="{{ route('sliders.update', $slider->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="">Heading</label>
                        <input type="text" name="heading" value="{{ $slider->heading }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id=""
                            class="form-control">{{ $slider->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Slider Image Upload</label>
                        <input type="file" name="image" class="form-control">
                        <img class="img-responsive" src="{{ asset('uploads/slider/' . $slider->image) }}"
                            alt="Slider Photo" width="100px">
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <input type="checkbox"
                            name="status {{ $slider->status == '1' ? 'checked' : '' }}">0=Visible
                        1=Hidde
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
