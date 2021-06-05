<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function genre_index()
    {
        $genres = Genre::latest()->paginate(10);

        return view('genre.index', compact('genres'))->with('i');
    }

    public function genre_create()
    {
        return view('genre.create');
    }

    public function genre_post(Request $request)
    {
        $this->validate($request, [
            'genre' => 'required|min:4|max:24',
        ]);

        Genre::create($request->all());

        return redirect()->route('genre.index')->with('success', 'Data successfully created');
    }

    public function genre_edit($id)
    {
        $genre = Genre::findOrFail($id);

        return view('genre.edit', compact('genre'));
    }

    public function genre_update(Request $request, $id)
    {
        $this->validate($request, [
            'genre' => 'required|min:4|max:24',
        ]);

        $post = Genre::findOrFail($id);

        $post->update([
            'genre' => $request->genre,
        ]);

        return redirect()->route('genre.index')->with('success', 'Data successfully updated');
    }

    public function genre_delete($id)
    {
        $post = Genre::findOrFail($id);
        $post->delete();

        return redirect()->route('genre.index')->with('success', 'Data successfully deleted');
    }
}
