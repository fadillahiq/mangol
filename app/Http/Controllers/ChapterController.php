<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChapterController extends Controller
{
    public function chapter_index()
    {
        $chapters = Chapter::latest()->paginate(10);

        return view('chapter.index', compact('chapters'))->with('i');
    }

    public function chapter_create()
    {
        $covers = Cover::all();
        return view('chapter.create', compact('covers'));
    }

    public function chapter_post(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:4',
            'image' => 'required',
            'cover_id' => 'required'
        ]);

        $post = new Chapter();
        $post->id = Str::slug($request->cover_id.'-'.$request->title);
        $post->title = $request->title;
        $post->image = $request->image;
        $post->cover_id = $request->cover_id;
        $post->save();

        return redirect()->route('chapter.index')->with('success', 'Data successfully created');
    }

    public function chapter_edit($id)
    {
        $covers = Cover::all();
        $chapter = Chapter::findOrFail($id);

        return view('chapter.edit', compact('chapter', 'covers'));
    }

    public function chapter_update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:4',
            'image' => 'required',
            'cover_id' => 'required'
        ]);

        $post = Chapter::findOrFail($id);

        $post->update($request->all());

        return redirect()->route('chapter.index')->with('success', 'Data successfully updated');
    }

    public function chapter_delete($id)
    {
        $post = Chapter::findOrFail($id);
        $post->delete();

        return redirect()->route('chapter.index')->with('success', 'Data successfully deleted');
    }
}
