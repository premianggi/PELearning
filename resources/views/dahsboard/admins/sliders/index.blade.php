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
                    <a href="{{ route('sliders.create') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus-square"> </i> Add Slider</a>
                </div>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session('success') }}
                </div>
            @endif
            <div class="box-body">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Heading</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            <?php $no=1;?>
                            @foreach ($sliders as $item)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $item->heading }}</td>
                                <td>
                                    <img class="img-responsive"
                                        src="{{ asset('../uploads/slider/' . $item->image) }}"
                                        alt="Slider Image" width="100px">
                                </td>
                                <td>
                                    @if ($item->status == 1)
                                    <label for="" class="btn btn-default btn-xs"><i class="fa fa-eye-slash"></i>Hidden</label>
                                    @else
                                    <label for="" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Visible</label>

                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('sliders.destroy', $item->id) }}" method="post" style="margin:0;">
                                        {{ csrf_field() }}
                                    <a href="{{ route('sliders.show', $item->id) }}"
                                        class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('sliders.edit', $item->id) }}"
                                        class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php $no++ ;?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
