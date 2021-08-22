{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Halaman Forum')
@section('name')
@section('box-title', 'Membuat Forum')
@section('content')

        <div class="row">
            <div class="col-sm-9 col-md-9 col-lg-9">
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
                                        <th scope="col" width="100">Action</th>
                                    </tr>
                                    @foreach ($forums as $forum)
                                        <tr>
                                            <td>
                                                <div class="forum_title">
                                                    <h4> <a
                                                            href="{{ route('forumslug', $forum->slug) }}">{{ Str::limit($forum->title, 30) }}</a>
                                                    </h4>
                                                    {{-- {{Str::limit($category->name, 20)}} --}}

                                                    <p>{!! Str::limit($forum->description, 50) !!}</p>
                                                    @foreach ($forum->tags as $tag)
                                                        <a href="#"
                                                            class="label label-success tag_label">#{{ $tag->name }}</a>
                                                    @endforeach
                                                    @if (empty($forum->image))
                                                    @else
                                                        <div class="label label-warning tag_label_image">
                                                            <i class="fa fa-image"></i>
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
                                            <td>
                                                <form action="{{ route('forum.destroy', $forum->id) }}" method="post"
                                                    style="margin: 0;">
                                                    {{ csrf_field() }}
                                                    <a href="{{ route('forum.edit', $forum->id) }}"
                                                        class="btn btn-sm btn-success"><i class="fa fa-edit"></i>
                                                    </a>
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{$forums->link}} --}}
                            {!! $forums->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @include('dahsboard.admins.layouts.popular')
            </div>
        </div>
@endsection
