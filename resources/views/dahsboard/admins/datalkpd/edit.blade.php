{{-- @extends('dashboard.admins.layouts.admindash') --}}
@extends('dahsboard.admins.layouts.admindash')

@section('title', 'Settings')
@section('sub-title', 'Edit Data LKPD')
@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        {{-- <div class="box box-primary"> --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('sub-title')</h3>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session('success') }}
                </div>
            @endif
            <div class="box-body">
                <form action="{{ route('datalkpd.update', $datalkpd->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Assignment Name</label>
                        <input type="text" name="assignment_name" class="form-control" value="{{ $datalkpd->assignment_name }}">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="summernote" class="form-control">{{ $datalkpd->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Add File</label>
                        <input type="file" name="add_file" id="image" class="form-control">
                      </div>
                      @if (empty($datalkpd->add_file))
                        <code><i class="fa fa-info-circle"></i>No File Available</code>
                      @else
                      <div class="form-group">
                          <div class="col-md-4">
                              <img src="{{ asset('images/'.$datalkpd->add_file) }}" alt="" width="100px">
                          </div>
                      </div>
                      @endif
                    {{-- <div class="form-group">
                        <label for="">Add File</label>
                        <input type="file" name="add_file" class="form-control">
                    </div> --}}
                    <div class="form-group">
                        <a href="{{ route('datalkpd.index') }}" class="btn btn-danger btn-sm">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['height', ['height']]
                ['view', ['fullscreen', 'codeview', 'help']],
                ['insert', ['link', 'picture', 'video']],

            ],
            height:200,
            popatmouse:true,

        });
    </script>

@endpush
