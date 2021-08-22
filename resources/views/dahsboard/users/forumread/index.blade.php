{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.users.layouts.userdash')

@section('title', 'Halaman Forum')
@section('name')
@section('box-title', 'Membuat Forum')
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
                                        <th scope="col">Thread</th>
                                        <th scope="col">Comments</th>
                                        <th scope="col">Views</th>
                                        <th scope="col">Created_at</th>
                                    </tr>
                                    @foreach ($forumread as $forum)
                                        <tr>
                                            <td>
                                                <div class="forum_title">
                                                    <h4> <a
                                                            href="{{ route('forumshowslug', $forum->slug) }}">{{ Str::limit($forum->title, 50) }}</a>
                                                    </h4>
                                                    {{-- {{Str::limit($category->name, 20)}} --}}

                                                    <p>{!! Str::limit($forum->description, 100) !!}</p>
                                                    @foreach ($forum->tags as $tag)
                                                        <a href="#"
                                                            class="label label-success tag_label">#{{ $tag->name }}</a>
                                                    @endforeach

                                                    @if (empty($forum->image))
                                                    @else
                                                        <div class="label label-warning tag_label">
                                                            <i class="fa fa-image"></i>
                                                        </div>
                                                    @endif
                                                    |
                                                    @if (empty($forum->file))
                                                    @else
                                                        <div class="label label-danger">
                                                            <i class="fa fa-file"></i>
                                                        </div>
                                                    @endif

                                                    @if (empty($forum->video))
                                                    @else
                                                        <div class="label label-info">
                                                            <i class="fa fa-file-movie-o (alias)"></i>
                                                        </div>
                                                    @endif

                                                </div>
                                            </td>
                                            <td style="text-align: center"><small>{{ $forum->comments->count() }}</small>
                                            </td>
                                            <td style="text-align: center"><small> {{ views($forum)->count() }} </small>
                                            </td>
                                            <td>
                                                <div class="forum_by">
                                                    <small
                                                        style="margin-bottom: 0; color: #666">{{ $forum->created_at->diffForHumans() }}</small>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {!! $forumread->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3">
                @include('dahsboard.users.layouts.popular')
            </div> --}}
        </div>
    </div>

@endsection
