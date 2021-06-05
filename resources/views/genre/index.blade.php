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
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('genre.create') }}">Create new genre</a>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Genre</th>
                                <th width="128px">Action</th>
                            </tr>
                            @forelse ($genres as $genre)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $genre->genre }}</td>
                                    <td>
                                        <form action="{{ route('genre.delete', $genre->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <a class="btn btn-warning btn-sm" href="{{ route('genre.edit', $genre->id) }}">Edit</a>
                                            <button class="btn btn-danger btn-sm" type="submit" onClick="return confirm('Apakah anda yakin ?')">Delete</button>
                                        </form>
                                    </td>
                            @empty
                                    <td colspan="12"><p class="text-center">Data masih kosong</p></td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
