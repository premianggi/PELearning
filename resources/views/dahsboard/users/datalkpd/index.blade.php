{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.users.layouts.userdash')

@section('title', 'Halaman Data LKPD')
@section('content')
<div class="panel panel-info">
    @foreach ($datalkpd as $day => $datalkpd_list)
        <div class="panel-heading"><h4> <i class="fa fa-calendar">{{ $day}}</i></h4></div>
        <table class="table table-hover">
            @foreach ($datalkpd_list as $data)
            <tr>
                <td>
                    <div class="panel-body">
                        <h4><a href="{{ route('datalkpdreadhow', $data->slug) }}"><i class="fa fa-tv"></i> {{ $data->assignment_name }} </a></h4>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    @endforeach
</div>
@endsection
