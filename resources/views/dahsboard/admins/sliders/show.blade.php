{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Show Data Sliders')
@section('sub-title', 'Show Data Sliders')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">@yield('sub-title')</h3>

        <div class="box-tools pull-right">
            <a href="{{ route('sliders.index') }}" class="btn btn-danger btn-sm">Kembali</a>
        </div>
    </div>
    <div class="box-body">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>Heading</th>
                        <td>{{ $slider->heading }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $slider->description }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($slider == '1')
                            <label for="" class="btn btn-default btn-xs"><i class="fa fa-eye-slash"></i>Hidden</label>
                            @else
                            <label for="" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Visible</label>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            <img class="img-responsive"
                            src="{{ asset('../uploads/slider/' . $slider->image) }}"
                            alt="Slider Image" width="30%" height="50%">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
