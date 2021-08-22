{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-md-6">

        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-newspaper-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Forum</span>
              <span class="info-box-number"></span>
            </div>
          </div>
        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="ion ion-ios-book"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Data LKPD</span>
            <span class="info-box-number"></span>
          </div>
        </div>
        <div class="info-box bg-aqua">
          <span class="info-box-icon"><i class="fa fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Users</span>
            <span class="info-box-number"></span>
          </div>
        </div>
    </div>
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
</div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Users Online</h3>
                </div>
                @php $users = DB::table('users')->get(); @endphp
                <div class="box-body">
                    <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Last Seen</th>
                            </tr>
                            <?php $no=1; ?>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $no }}</td>
                                <td><a href="{{ route('datausers.show', $user->id) }}">{{$user->name}}</a></td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if(Cache::has('is_online' . $user->id))
                                        <span class="text-success label label-success">Online</span>
                                    @else
                                        <span class="text-secondary label label-danger">Offline</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</td>
                            </tr>
                            <?php $no++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
              </div>
        </div>
    </div>
@endsection
