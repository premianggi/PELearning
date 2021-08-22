{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Dashboard')
@section('name')
@section('box-title', 'Halaman Ubah Forum');
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">@yield('box-title')</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" method="POST" action="{{ route('forum.update', $forums->id) }}" enctype= multipart/form-data>
        {{ csrf_field() }}
        @method('PUT')
        <div class="box-body">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $forums->title }}">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="summernote" class="form-control">{{ $forums->description }}</textarea>
          </div>
          <div class="form-group">
            <label for="tag">Tags</label>
            <select name="tags[]" multiple="multiple" class="form-control tags">
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
              @endforeach
            </select>
        </div>
          <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" name="image" id="image" class="form-control">
          </div>
          @if (empty($forums->image))
            <code><i class="fa fa-info-circle"></i>No Image Available</code>
          @else
          <div class="form-group">
              <div class="col-md-4">
                  <img src="{{ asset('images/'.$forums->image) }}" alt="" width="100px">
              </div>
          </div>
          @endif

          <div class="form-group">
            <label for="image">Upload File</label>
            <input type="file" name="file" id="file" class="form-control">
          </div>
          @if (empty($forums->file))
            <code><i class="fa fa-info-circle"></i>No File Available</code>
          @else
          <div class="form-group">
              <div class="col-md-4">
                  <code><i class="fa fa-file" style="font-size:100%">File Available</i></code>
                  {{-- <img src="{{ asset('materi/'.$forums->file) }}" alt="" width="100px"> --}}
              </div>
          </div>
          @endif

          <div class="form-group">
            <label for="image">Upload Video</label>
            <input type="file" name="video" id="video" class="form-control">
          </div>
          @if (empty($forums->video))
            <code><i class="fa fa-info-circle"></i>No File Available</code>
          @else
          <div class="form-group">
              <div class="col-md-4">
                  <code><i class="fa fa-file-video-o">Video Available</i></code>
              </div>
          </div>
          @endif

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.box -->

  </div>
@endsection
@section('js')
<script type="text/javascript">

    $(".tags").select2().val({!! json_encode($forums->tags()->allRelatedIds()) !!}).trigger('change');

</script>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('summernote/summernote.min.css') }}" rel="stylesheet">
@endpush


@push('js')
    <script type="text/javascript" src="{{ asset('summernote/summernote.min.js') }}"></script>
    <script type="text/javascript">
        // $(document).ready(function() {
        //     $('#summernote').summernote();
        // })

        $('#summernote').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['height', ['height']]
                ['view', ['fullscreen', 'codeview', 'help']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            height:200,
            popatmouse:true,
            shortcuts: true,
            blockquoteBreakingLevel: 2

                // tabDisable: false,
                // disableDragAndDrop: true,
                // dialogsFade: true,
                // dialogsInBody: true,
        });
    </script>

@endpush
