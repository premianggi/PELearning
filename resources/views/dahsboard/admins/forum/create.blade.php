{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Dashboard')
@section('name')
@section('box-title', 'Halaman Membuat Forum')
@section('content')
<div class="box">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">@yield('box-title')</h3>
      </div>
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  @if (session('info'))
  <div class="alert alert-success">
      <i class="fa fa-check"></i>{{ session('info') }}</div>
  </div>
  @endif
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" method="post" action="{{ route('forum.store') }}" enctype= multipart/form-data>
        {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="summernote" class="form-control" placeholder="Enter Description"></textarea>
          </div>
          <div class="form-group">
              <label for="tags">Tags</label>
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
          <div class="form-group">
            <label for="image">Upload File</label>
            <input type="file" name="file" id="file" class="form-control">
          </div>
          <div class="form-group">
            <label for="image">Upload Video</label>
            <input type="file" name="video" id="video" class="form-control">
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
        </div>
      </form>
</div>

@endsection
@section('js')
<script type="text/javascript">
    $(".tags").select2({
        placeholder:"Select Tag",
        minimumSelectionLength:2
    })

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
