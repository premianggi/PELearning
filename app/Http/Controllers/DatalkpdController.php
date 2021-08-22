<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Datalkpd;
use DB;
class DatalkpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datalkpd = Datalkpd::whereBetween('created_at', [now(), now()->addDays(7)])
        // ->orderBy('created_at')
        // ->get()
        // ->groupBy(function ($val) {
        //     return Carbon::parse($val->created_at)->format('d');
        // });

        $datalkpd = Datalkpd::orderBy('created_at')->get()->groupBy(function($item) {
            return $item->created_at->format('d-M-Y');
        });
        return view('dahsboard.admins.datalkpd.index', compact('datalkpd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dahsboard.admins.datalkpd.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $datalkpd = new Datalkpd;
        $datalkpd->assignment_name = $request->assignment_name;
        $datalkpd->slug = $slug = Str::slug($request->assignment_name);
        $datalkpd->description = $request->description;
        if ($request->file('add_file')) {
            $file = $request->file('add_file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $location = public_path('/add_file');
            $file->move($location, $filename);
            $datalkpd->add_file = $filename;
        }
        $datalkpd->save();
        return back()->withInfo('Data LKPD Telah di buat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $datalkpd = DB::table('datalkpd')->where('slug', $slug)->get();
        return view('dahsboard.admins.datalkpd.show', compact('datalkpd'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datalkpd = Datalkpd::find($id);
        return view('dahsboard.admins.datalkpd.edit', compact('datalkpd'));
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
        $datalkpd = Datalkpd::find($id);
        $datalkpd->assignment_name = $request->assignment_name;
        $datalkpd->slug = $slug = Str::slug($request->assignment_name);
        $datalkpd->description = $request->description;
        if ($request->file('add_file')) {
            $file = $request->file('add_file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $location = public_path('/add_file');
            $file->move($location, $filename);

            $oldAddFile = $datalkpd->add_file;
            \Storage::delete($oldAddFile);

            $datalkpd->add_file = $filename;
        }
        $datalkpd->save();
        return back()->withInfo('Data LKPD Berhasil di Update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datalkpd = Datalkpd::find($id);
        $datalkpd->delete();
        return back()->withInfo('Data LKPD di Hapus');
    }

    // public function datalkpdread()
    // {
    //     $datalkpdread = Datalkpd::paginate(5);
    //     return view('dahsboard.users.datalkpd.index', compact('datalkpdread'));
    // }

    public function datalkpdread()
    {
        // $datalkpd = Datalkpd::whereBetween('created_at', [now(), now()->addDays(7)])
        // ->orderBy('created_at')
        // ->get()
        // ->groupBy(function ($val) {
        //     return Carbon::parse($val->created_at)->format('d');
        // });

        $datalkpd = Datalkpd::orderBy('created_at')->get()->groupBy(function($item) {
            return $item->created_at->format('d-M-Y');
        });
        return view('dahsboard.users.datalkpd.index', compact('datalkpd'));
    }

    // public function datalkpdreadhow($slug)
    // {
    //     $datalkpdreadshow = Datalkpd::where('slug',$slug)
    //                     ->firstOrFail();
    //     return view('dahsboard.users.datalkpd.show', compact('datalkpdreadshow'));
    // }

    public function datalkpdreadhow($slug)
    {

        $datalkpdreadhow = DB::table('datalkpd')->where('slug', $slug)->get();
        return view('dahsboard.users.datalkpd.show', compact('datalkpdreadhow'));

    }

}
