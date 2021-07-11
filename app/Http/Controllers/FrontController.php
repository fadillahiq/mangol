<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\ChapterComment;
use App\Models\Comment;
use App\Models\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    public function mangol_index()
    {
        $completes = DB::table('covers')->where('status', 'Completed')->orderBy('created_at', 'desc')->get();
        $new_chapters = Chapter::latest()->paginate(10);
        $comics = Cover::where('status', 'On Going')->get();
        
        return view('front.home', compact('completes', 'new_chapters', 'comics'));
    }

    public function mangol_detail($id)
    {
        $comic = Cover::findOrFail($id);
        $chapters = Chapter::all();
        return view('front.detail', compact('comic', 'chapters'));
    }

    public function mangol_chapter($id)
    {
        $comics = DB::table('covers')->get();
        $chapter = Chapter::findOrFail($id);
        //
        $new_chapters = DB::table('chapters')->where('cover_id', $chapter->cover_id)->orderBy('title', 'desc')->get();
        
        // get previous user id
        $previous = Chapter::where('id', '<', $chapter->id)->max('id');

        // get next chapter id
        $next = Chapter::where('id', '>', $chapter->id)->min('id');
        return view('front.chapter',compact('chapter', 'new_chapters','comics',))->with('previous', $previous)->with('next', $next);
    }

    public function mangol_complete()
    {
        $comics = DB::table('covers')->where('status', 'Completed')->get();

        return view('front.completed', compact('comics'));
    }

    public function mangol_all()
    {
        $comics = DB::table('covers')->orderBy('created_at', 'desc')->get();

        return view('front.all', compact('comics'));
    }

    public function mangol_comments(Request $request, $id)
    {
        $cover = Cover::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|min:4|max:32',
            'body' => 'required|max:300'
        ]);

        $post = new Comment();
        $post->name = $request->name;
        $post->body = $request->body;
        $post->cover_id = $cover->id;
        $post->save();

        return redirect()->back();
    }

    public function mangol_comments_chapter(Request $request, $id)
    {
        $chapter = Chapter::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|min:4|max:32',
            'body' => 'required|max:300'
        ]);

        $post = new ChapterComment();
        $post->name = $request->name;
        $post->body = $request->body;
        $post->chapter_id = $chapter->id;
        $post->save();

        return redirect()->back();
    }

    public function search(Request $request)
	{
		// menangkap data pencarian
		$search = $request->search;

    		// mengambil data dari table pegawai sesuai pencarian data
		$comics = DB::table('covers')
		->where('title','like',"%".$search."%")
        ->get();

    		// mengirim data pegawai ke view index
		return view('front.search', compact('comics'));

	}
}
