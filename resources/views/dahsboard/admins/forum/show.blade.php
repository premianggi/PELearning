@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Dashboard')
@section('name')
@section('box-title', 'Halaman Show Forum')
@section('content')

<div class="container-fluid">
    <div class="col-md-8">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Ringkasan Materi</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Material</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Video</a></li>
                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="box-body">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                    <p class="text-left">
                                        <span class="label label-success">{{ Auth::user()->name }}</span>
                                        <small>{{ $forums->created_at->diffForHumans() }}</small> |
                                        <span> {{ views($forums)->count() }} View |</span>
                                        <span> {{ $forums->comments->count() }} Comment</span>
                                        @foreach ($forums->tags as $tag)
                                            <span class="label label-success">#{{ $tag->name }}</span>
                                        @endforeach
                                        @if (empty($forums->image))
                                        @else
                                            <span class="label label-success"><i class="fa fa-image"></i></span>
                                        @endif
                                    </p>
                                    {{-- @include('info') --}}
                                    <h3>{{ $forums->title }}</h3>
                                    <hr>
                                    @if (empty($forums->image))
                                    @else
                                        <a href="#myModal" data-toggle="modal" data-target="#myModal">
                                            <img class="img-responsive" src="{{ asset('images/' . $forums->image) }}"
                                                alt="" width="100%">
                                        </a>
                                    @endif

                                    <p class="card-text">{!! $forums->description !!}</p>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add A Comment</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="post">
                                @forelse ($forums->comments as $comment)
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('backend') }}/dist/img/user1-128x128.jpg" alt="user image">
                                        <span class="username">
                                            <a href="#">{{ $comment->user->name }}</a>
                                            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                        </span>
                                        <span class="description"><i class="fa fa-clock-o"></i>
                                            {{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        {{ $comment->content }}
                                    </p>
                                    <ul class="list-inline">
                                        <li><a data-toggle="collapse" href="#{{ $comment->id }}-collapse1info"
                                                class="text-sm link-black"><i class="fa fa-info margin-r-5"></i>
                                                info</a></li>
                                        <li class="pull-right">
                                            <a data-toggle="collapse" href="#{{ $comment->id }}-collapse1reply"
                                                class="text-sm link-black"><i class="fa fa-comments-o margin-r-5"></i>
                                                Reply</a>
                                        </li>
                                    </ul>
                                    <div id="{{ $comment->id }}-collapse1info" class="card-collapse collapse">
                                        <div class="card-body">*Klik 'Reply' untuk melihat atau membuat komentar
                                            balasan.</div>
                                    </div>

                                    <div id="{{ $comment->id }}-collapse1reply" class="card-collapse collapse">
                                        {{-- <div class="col-md-12"> --}}
                                        <div class="box box-solid">
                                            <!-- /.box-header -->
                                            @forelse ($comment->comments as $reply)
                                                <div class="box-body">
                                                    <dl class="dl-horizontal">
                                                        <dt>
                                                            <div class="user-block">
                                                                <img class="img-circle img-bordered-sm"
                                                                    src="{{ asset('backend') }}/dist/img/user1-128x128.jpg"
                                                                    alt="user image">
                                                                <span class="username">
                                                                    <a href="#">{{ $reply->user->name }}</a>
                                                                </span>
                                                                <span class="description"><i class="fa fa-clock-o"></i>
                                                                    {{ $reply->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </dt>
                                                        <dd>
                                                            <p>
                                                                {{ $reply->content }}
                                                            </p>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            @empty
                                                <p>No replyComment</p><br>
                                            @endforelse
                                            <!-- /.box-body -->
                                        </div>
                                        {{-- </div> --}}
                                        <div class="post">
                                            <div class="panel-body" style="    border-top: 1px solid #eee;">
                                                <form action="{{ route('replyComment', $comment->id) }}"
                                                    method="post" style="    padding: 0 16px;">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <input type="text" name="content" class="form-control"
                                                            id="input_reply" placeholder="Reply here..">
                                                    </div>
                                                    <button class="btn btn-success" type="submit">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No Comment</p>
                                @endforelse
                                <hr>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="panel box box-danger">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    Comment
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="box-body">
                                @if (Auth::check())
                                    <div class="post">
                                        <form action="{{ route('addComment', $forums->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="Your Comment">Your Comment :</label>
                                                <input type="text" name="content" class="form-control input-sm" id=""
                                                    placeholder="Your Comment">
                                            </div>
                                            <div class="button-gg">
                                                <button type="submit" class="btn btn-success">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}">
                                        <p>Login to comment</p>
                                    </a>
                                @endguest
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                <p class="alert alert-info ">Jika mau download materi Silahkan Klik Tombol <a
                        href="/file/download/{{ $forums->file }}" class="btn btn-danger btn-sm">Download</a></p>
                <div class="timeline-item">
                    <div class="timeline-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe src="{{ url('materi/' . $forums->file) }}" height="100%" width="100%"
                                frameborder="1"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">

                <div class="timeline-item">
                    <div class="timeline-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe src="{{ url('video/' . $forums->video) }}" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
                </li>
            </div>
        </div>
    </div>

</div>


<div class="col-md-4">
    <div class="panel panel-info">
        @include('dahsboard.admins.layouts.popular')
    </div>
</div>
</div>


@endsection
