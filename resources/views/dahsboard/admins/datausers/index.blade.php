{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Halaman Data Users')
@section('name')
@section('box-title', 'Halaman Data Users')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col" width="300">Action</th>
                                    </tr>
                                    <?php $no=1;?>
                                    @foreach ($datausers as $datauser)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $datauser->name }}</td>
                                            <td>{{ $datauser->email }}</td>
                                            <td>
                                                {{-- @if ($datausers==1)
                                                <label for="" class="btn btn-warning btn-sm">{{ $datauser->role }}</label>
                                                @endif --}}
                                                @if ($datauser->role == 1)
                                                    <label for="" class="btn btn-default btn-sm"><strong>Admin</strong></label>
                                                @endif
                                                @if ($datauser->role == 2)
                                                <label for="" class="btn btn-primary btn-sm"><strong>Users</strong></label>
                                            @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('datausers.destroy', $datauser->id) }}" method="post">
                                                    @csrf
                                                    <a href="{{ route('datausers.show', $datauser->id) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('datausers.edit', $datauser->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $no++ ;?>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{$forums->link}} --}}
                            {{-- {!! $datausers->render() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
