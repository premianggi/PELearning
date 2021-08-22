<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datausers = User::all();
        return view('dahsboard.admins.datausers.index', compact('datausers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dahsboard.admins.datausers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required', 'string', 'max:value255'],
            'email'=>['required', 'string','email','max:value255'],
            'password'=>['required', 'string', 'min:8', 'confirmed'],
        ]);

       //  Make avata
       $path = 'users/images/';
       $fontPath = public_path('fonts/Oliciy.ttf');
       $char = strtoupper($request->name[0]);
       $newAvatarName = rand(12, 34353).time().'_avatar.png';
       $dest = $path.$newAvatarName;

       $createAvatar = makeAvatar($fontPath, $dest, $char);
       $picture = $createAvatar == true ? $newAvatarName : '';

       $user = new User();
       $user->name=$request->name;
       $user->email=$request->email;
       $user->role=2;
       $user->picture=$picture;
       $user->password=\Hash::make($request->password);

       if ($user->save()) {
           return redirect()->back()->with('success', 'You are now successfully registerd');
       } else {
           return redirect()->back()->with('error', 'Failed to register');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datausers = User::find($id);
        return view('dahsboard.admins.datausers.show', compact('datausers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datausers = User::find($id);
        return view('dahsboard.admins.datausers.edit', compact('datausers'));
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
        $validator = \Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email'
        ]);
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        } else {
            $query = User::find($id)->update([
                'name' => $request->name,
                'email'=>$request->email,
            ]);

            if (!$query) {
                return response()->json(['status'=>0, 'msg'=>'Something went wrong.']);
            } else {
                return response()->json(['status'=>1, 'msg'=>'Your profile info has been update successfuly.']);
            }
        }
        return view('dahsboard.admins.datausers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datausers = User::find($id);
        $datausers->delete();
        return redirect()->route('datausers.index')->withInfo('Data User Berhasil di hapus.');
    }
}
