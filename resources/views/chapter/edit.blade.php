@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create Cover') }}<a class="btn btn-primary btn-sm float-right" href="{{ route('chapter.index') }}">Back</a></div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('chapter.update', $chapter->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="title">Tilte</label>
                                <input id="title" class="form-control" type="text" name="title" value="{{ $chapter->title }}" placeholder="Please insert title manga" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cover_id">Komik</label>
                                <select class="form-control" name="cover_id" id="cover_id">
                                    @foreach ($covers as $cover)
                                        <option value="{{ $cover->id }}" @if( $chapter->cover_id == $cover->id ) selected @endif>{{ $cover->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="image">Image</label>
                                <textarea class="form-control" name="image" id="image" cols="30" rows="10">{!! $chapter->image !!}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button class="btn btn-success col-md-12" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script>
        var options = {
          filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
          filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
          filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
          filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        CKEDITOR.replace( 'image', options );
    </script>
@endpush

