<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CoverController extends Controller
{
    public function cover_index()
    {
        $covers = Cover::latest()->paginate(10);

        return view('cover.index', compact('covers'))->with('i');
    }

    public function cover_create()
    {
        $genres = Genre::all();
        return view('cover.create', compact('genres'));
    }

    public function cover_post(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:8|max:64',
            'image' => 'required|image|max:10240|mimes:jpeg,png,jpg,gif,svg',
            'synopsis' => 'required|min:30',
            'type' => 'required',
            'released' => 'required|numeric',
            'status' => 'required',
            'author' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('img', $image, 'public');
        }

        $post = new Cover();
        $post->id = Str::slug($request->title);
        $post->title = $request->title;
        $post->synopsis = $request->synopsis;
        $post->type = $request->type;
        $post->released = $request->released;
        $post->status = $request->status;
        $post->author = $request->author;
        $post->image = $image;
        $post->save();

        $post->genres()->attach($request->genre);

        return redirect()->route('cover.index')->with('success', 'Data successfully created');
    }

    public function cover_edit($id)
    {
        $genres = Genre::all();
        $cover = Cover::findOrFail($id);

        return view('cover.edit', compact('cover', 'genres'));
    }

    public function cover_update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:8',
            'image' => 'image|max:10240|mimes:jpeg,png,jpg,gif,svg',
            'synopsis' => 'required|min:30',
            'type' => 'required',
            'released' => 'required|numeric',
            'status' => 'required',
            'author' => 'required',
        ]);

        $post = Cover::findOrFail($id);
        $image = $post->image;

        if ($request->hasFile('image')) {
            if ($image) {
                Storage::delete('/public/img/' . $image);
            }
            $image = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('img', $image, 'public');
        }

        $post->update([
            'id' => Str::slug($request->title),
            'title' => $request->title,
            'image' => $image,
            'synopsis' => $request->synopsis,
            'type' => $request->type,
            'released' => $request->released,
            'status' => $request->status,
            'author' => $request->author,
        ]);
        $post->genres()->sync($request->genre);



        return redirect()->route('cover.index')->with('success', 'Data successfully updated');
    }

    public function cover_delete($id)
    {
        $post = Cover::findOrFail($id);
        $post->delete();
        $post->genres()->detach();
        Storage::delete('/public/img/' . $post->image);

        return redirect()->route('cover.index')->with('success', 'Data successfully deleted');
    }
}
