<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Forum;
use Str;
use DB;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polulars = DB::table('forums')
        ->join('views', 'forums.id', '=', 'views.viewable_id')
        ->select(DB::raw('count(viewable_id) as count'), 'forums.id', 'forums.title', 'forums.slug')
        ->groupBy('forums.id', 'title', 'slug')
        ->orderBy('count', 'desc')
        ->take(5)
        ->get();

        $tags = Tag::all();
        return view('dahsboard.admins.tag.index', compact('tags', 'polulars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::paginate(6);
        return view('dahsboard.admins.tag.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->save();

        return back()->withInfo('Tag baru telah dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $polulars = DB::table('forums')
        ->join('views', 'forums.id', '=', 'views.viewable_id')
        ->select(DB::raw('count(viewable_id) as count'), 'forums.id', 'forums.title', 'forums.slug')
        ->groupBy('forums.id', 'title', 'slug')
        ->orderBy('count', 'desc')
        ->take(5)
        ->get();
        $tags = Forum::where('slug', $slug)
            ->orWhere('slug', $slug)
            ->firstOrFail();
        // views($forums)->record();

        return view('dahsboard.admins.tag.show', compact('tags', 'polulars'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('dahsboard.admins.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->save();

        return redirect()->route('tag.create')->withInfo('Data Tag Berhasil diUpdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return redirect()->route('tag.create')->withInfo('Data Tag Berhasil diHapus.');
    }

    public function showTag()
    {
        $showTag = Tag::all();
        return view('dahsboard.admins.index', compact('showTag'));
    }

    public function showTagUser()
    {
        $showTag = Tag::all();
        return view('dahsboard.users.index', compact('showTag'));
    }
}
