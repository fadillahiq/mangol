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
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('chapter.create') }}">Create new data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Komik ID</th>
                                <th width="128px">Action</th>
                            </tr>
                            @forelse ($chapters as $chapter)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $chapter->id }}</td>
                                <td>{{ $chapter->title }}</td>
                                <td>{{ $chapter->cover->title }}</td>
                                <td>
                                    <form action="{{ route('chapter.delete', $chapter->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ route('chapter.edit', $chapter->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <button class="btn btn-danger btn-sm" type="submit" onClick="return confirm('Apakah anda yakin ?')">Delete</button>
                                    </form>
                                </td>
                            @empty
                                <td colspan="12"><p class="text-center">Data masih kosong</p></td>
                            </tr>
                            @endforelse
                        </table>
                        {!! $chapters->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
