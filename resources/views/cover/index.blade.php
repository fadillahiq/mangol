@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Menu</div>
                @include('layouts.menu')
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif

                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('cover.create') }}">Create new cover</a>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>No.</th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Synopsis</th>
                                <th>Type</th>
                                <th>Released</th>
                                <th>Status</th>
                                <th>Author</th>
                                <th>Genre</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($covers as $cover)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $cover->id }}</td>
                                    <td>{{ $cover->title }}</td>
                                    <td><img class="img-fluid" src="{{ asset('storage/img/'.$cover->image) }}" alt="gambar cover" width="200"></td>
                                    <td>{{ Str::limit($cover->synopsis, 50) }}</td>
                                    <td>{{ $cover->type }}</td>
                                    <td>{{ $cover->released }}</td>
                                    <td>{{ $cover->status }}</td>
                                    <td>{{ $cover->author }}</td>
                                    <td>
                                        @foreach ($cover->genres as $genre)
                                            <ul>
                                                <li>{{ $genre->genre }}</li>
                                            </ul>
                                        @endforeach
                                    </td>
                                    <td>
                                        <form class="d-flex" action="{{ route('cover.delete', $cover->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <a class="btn btn-warning btn-sm mr-1" href="{{ route('cover.edit', $cover->id) }}">Edit</a>
                                            <button class="btn btn-danger btn-sm" type="submit" onClick="return confirm('Apakah anda yakin ?')">Delete</button>
                                        </form>
                                    </td>

                            @empty
                                    <td colspan="12"><p class="text-center">Data masih kosong</p></td>
                                </tr>
                            @endforelse
                        </table>
                        {!! $covers->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
