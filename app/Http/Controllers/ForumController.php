<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function populars()
    {
        $polulars = DB::table('forums')
            ->join('views', 'forums.id', '=', 'views.viewable_id')
            ->select(DB::raw('count(viewable_id) as count'), 'forums.id', 'forums.title', 'forums.slug')
            ->groupBy('forums.id', 'title', 'slug')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();
        // $forums = Forum::paginate(6);
        return view('forum.populars', compact('polulars'));
    }

    public function index()
    {
        $polulars = DB::table('forums')
            ->join('views', 'forums.id', '=', 'views.viewable_id')
            ->select(DB::raw('count(viewable_id) as count'), 'forums.id', 'forums.title', 'forums.slug')
            ->groupBy('forums.id', 'title', 'slug')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();
        $forums = Forum::Paginate(5);
        return view('dahsboard.admins.forum.index', compact('forums', 'polulars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('dahsboard.admins.forum.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'image' => 'image|mimes:png,jpg, jpeg, gif|max:1024',
        ]);

        $forums = new Forum;
        $forums->user_id = Auth::user()->id;
        $forums->title = $request->title;
        $forums->slug = Str::slug($request->title);
        $forums->description = $request->description;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $location = public_path('/images');
            $file->move($location, $filename);
            $forums->image = $filename;
        }

        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $location = public_path('/materi');
            $file->move($location, $filename);
            $forums->file = $filename;
        }

        if ($request->file('video')) {
            $file = $request->file('video');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $location = public_path('/video');
            $file->move($location, $filename);
            $forums->video = $filename;
        }

        $forums->save();
        $forums->tags()->sync($request->tags);
        return back()->withInfo('Berhasil di buat forum.');
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
        $forums = Forum::where('slug', $slug)
            ->firstOrFail();
        views($forums)->record();

        return view('dahsboard.admins.forum.show', compact('forums', 'polulars'));
    }

    public function download($file)
    {
        return response()->download('materi/'.$file);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::all();
        $forums = Forum::find($id);
        // dd($forums);
        return view('dahsboard.admins.forum.edit', compact('forums', 'tags'));
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
        $forums = Forum::find($id);
        $forums->user_id = Auth::user()->id;
        $forums->title = $request->title;
        $forums->slug = Str::slug($request->title);
        $forums->description = $request->description;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $location = public_path('/images');
            $file->move($location, $filename);

            $oldImage = $forums->image;
            \Storage::delete($oldImage);

            $forums->image = $filename;
        }

        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $location = public_path('/materi');
            $file->move($location, $filename);

            $oldImage = $forums->image;
            \Storage::delete($oldImage);

            $forums->file = $filename;
        }

        if ($request->file('video')) {
            $file = $request->file('video');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $location = public_path('/video');
            $file->move($location, $filename);

            $oldImage = $forums->image;
            \Storage::delete($oldImage);

            $forums->video = $filename;
        }

        $forums->save();
        $forums->tags()->sync($request->tags);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forum = Forum::find($id);
        Storage::delete($forum->image);
        $forum->tags()->detach();
        $forum->delete();
        return back()->withInfo('Data berhasil dihapus');
    }

    public function forumread()
    {
        $forumread = Forum::paginate(5);
        return view('dahsboard.users.forumread.index', compact('forumread'));
    }

    public function forumshow($slug)
    {
        $polulars = DB::table('forums')
            ->join('views', 'forums.id', '=', 'views.viewable_id')
            ->select(DB::raw('count(viewable_id) as count'), 'forums.id', 'forums.title', 'forums.slug')
            ->groupBy('forums.id', 'title', 'slug')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();
        $forums = Forum::where('slug', $slug)
            ->firstOrFail();
        views($forums)->record();

        return view('dahsboard.users.forumread.show', compact('forums', 'polulars'));
    }

    public function readpopulars()
    {
        $polulars = DB::table('forums')
            ->join('views', 'forums.id', '=', 'views.viewable_id')
            ->select(DB::raw('count(viewable_id) as count'), 'forums.id', 'forums.title', 'forums.slug')
            ->groupBy('forums.id', 'title', 'slug')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();
            dd($polulars);
        // $forums = Forum::paginate(6);
        return view('dahsboard.users.layouts.popular', compact('polulars'));
    }
}
