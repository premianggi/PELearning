{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Dashboard')
@section('content')
<div class="panel panel-info">
    @foreach ($datalkpd as $day => $datalkpd_list)
        <div class="panel-heading"><h4> <i class="fa fa-calendar">{{ $day}}</i></h4></div>
        <table class="table table-hover">
            <tr>
                <th>Title</th>
                <th width="100px">Action</th>
            </tr>
            @foreach ($datalkpd_list as $data)
            <tr>
                <td>
                    <div class="panel-body">
                        <h4><a href="{{ route('datalkpdslug', $data->slug) }}"><i class="fa fa-tv"></i> {{ $data->assignment_name }} </a></h4>
                    </div>
                </td>
                <td>
                    <form action="{{ route('datalkpd.destroy', $data->id) }}" method="post">
                        {{ csrf_field() }}
                        <a href="{{ route('datalkpd.edit', $data->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    @endforeach
</div>
@endsection
