<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        // dd($slider);
        return view('dahsboard.admins.sliders.index', compact('sliders'));
    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dahsboard.admins.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider;
        $slider->heading = $request->input('heading');
        $slider->description = $request->input('description');

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/slider/', $filename);
            $slider->image =$filename;
        }
        $slider->status = $request->input('status') == true ? '1':'0';
        $slider->save();
        return redirect()->back()->with('success', 'Slider Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider = Slider::find($id);
        return view('dahsboard.admins.sliders.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('dahsboard.admins.sliders.edit', compact('slider'));
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
        $slider = Slider::find($id);
        $slider->heading = $request->input('heading');
        $slider->description = $request->input('description');
        $slider->status = $request->input('status') == true ? '1':'0';
        if ($request->hasfile('image')) {
            $destination = 'uploads/slider'.$slider->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/slider/', $filename);
            $slider->image =$filename;
        }
        $slider->save();
        return redirect()->back()->with('success', 'Slider Update Successfully');
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        return redirect()->route('sliders.index')->withInfo('Data Sliders Berhasil diHapus.');
    }

    public function sliderLogin()
    {
        $sliders = Slider::where('status', '0')->get();
        // dd($sliders);
        return view('welcome', compact('sliders'));
    }
}
