@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Cover') }}<a class="btn btn-primary btn-sm float-right" href="{{ route('cover.index') }}">Back</a></div>

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

            <form action="{{ route('cover.update', $cover->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="title">Title</label>
                        <input id="title" class="form-control" type="text" name="title" placeholder="Please insert title manga" value="{{ $cover->title }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="type">Type</label>
                        <input id="type" class="form-control" type="text" name="type" placeholder="Please insert type manga" value="{{ $cover->type }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="released">Released</label>
                        <input id="released" class="form-control" type="number" name="released" placeholder="Please insert released manga" value="{{ $cover->released }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="On Going" @if($cover->status == "On Going") selected @endif>On Going</option>
                            <option value="Completed" @if($cover->status == "Completed") selected @endif>Completed</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="author">Author</label>
                        <input id="author" class="form-control" type="text" name="author" placeholder="Please insert author manga" value="{{ $cover->author }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label" for="genre">Genre</label>
                        <select class="selectpicker form-control" name="genre[]" multiple="" id="genre">
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}"
                                @foreach ($cover->genres as $value)
                                    @if($genre->id == $value->id)
                                    selected
                                    @endif
                                @endforeach
                                    >{{ $genre->genre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
               <div class="row">
                <div class="form-group col-md-12">
                    <label for="synopsis">Synopsis</label>
                    <textarea class="form-control" name="synopsis" id="synopsis" cols="30" rows="10" placeholder="Please insert synopsis manga" required>{{ $cover->synopsis }}</textarea>
                </div>
               </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="image">Image</label>
                        <input id="image" class="form-control" onchange="loadPreview(this);" type="file" name="image">
                        <p class="mt-1">Preview Image</p>
                        <img id="preview_img" src="../../../img/spinner.gif" class="img-fluid" width="200"/>
                        <p class="mt-1">Old Image</p>
                        <img src="{{ asset('storage/img/'.$cover->image) }}" class="img-fluid" width="200"/>
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
<script>
    function loadPreview(input, id) {
      id = id || '#preview_img';
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $(id)
                      .attr('src', e.target.result)
                      .width(200)
                      .height(150);
          };

          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('select/css/bootstrap-select.min.css') }}">
@endpush
@push('scripts')
    <script type="text/javascript" src="{{ asset('select/js/bootstrap-select.min.js') }}"></script>
@endpush

