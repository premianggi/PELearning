<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    public function totalUsers()
    {
        $dataUsers = User::all();
        // dd($dataUsers);
        return view('dahsboard.admins.index', compact('dataUsers'));
    }
    // Status
    public function status()
    {
        $users = User::all();
        return view('dahsboard.admins.index', compact('users'));
    }

    public function index()
    {
        return view('dahsboard.admins.index');
    }

    public function profile()
    {
        return view('dahsboard.admins.profile');
    }
    public function settings()
    {
        $datas = Setting::all();
        return view('dahsboard.admins.settings.index', compact('datas'));
    }

    public function store(Request $request)
    {
        $setting = new Setting;
        $setting->short_name = $request->short_name;
        $setting->full_name = $request->full_name;
        $setting->copyright = $request->copyright;
        $setting->save();

        return back()->withInfo('Setting baru telah dibuat.');
    }

    public function edit()
    {
        $setting = Setting::where('id', '=','1');
        dd($setting);
        return view('dahsboard.admins.settings.index', compact('setting'));
    }

    public function updateInfo(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email'
        ]);
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        } else {
            $query = User::find(Auth::user()->id)->update([
                'name' => $request->name,
                'email'=>$request->email,
            ]);

            if (!$query) {
                return response()->json(['status'=>0, 'msg'=>'Something went wrong.']);
            } else {
                return response()->json(['status'=>1, 'msg'=>'Your profile info has been update successfuly.']);
            }
        }
    }

    public function changePassword(Request $request)
    {
        // validate form
        $validator = \Validator::make($request->all(),[
            'oldpassword'=>[
                'required', function($attribute, $value, $fail){
                    if(!\Hash::check($value, Auth::user()->password)){
                        return $fail(__('The current password is incorrect'));
                    }
                },
                'min:6',
                'max:30'
            ],
            'newpassword'=>'required|min:6|max:30',
            'cnewpassword' => 'required|same:newpassword'
        ],[
            'oldpassword.required'=>'Enter your current password',
            'oldpassword.min'=>'Old password must be at least 6 characters',
            'oldpassword.max'=>'Old password must not be greater than 30 characters',
            'newpassword.required'=>'Enter new password',
            'newpassword.min'=>'New password must be at least 6 characters',
            'newpassword.max'=>'New password and confirm  new password must match',

        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->newpassword)]);

            if(!$update){
                return response()->json(['status'=>0, 'msg'=>'Something went wrong, failed to update password in db']);
            }else{
                return response()->json(['status'=>1, 'msg'=>'Your password has been changed successfully']);
            }
        }
    }





    function crop(Request $request){
        $path = 'files/';
        $file = $request->file('file');
        $new_image_name = 'UIMG'.date('Ymd').uniqid().'.jpg';
        $upload = $file->move(public_path($path), $new_image_name);
        if($upload){
            return response()->json(['status'=>1, 'msg'=>'Image has been cropped successfully.', 'name'=>$new_image_name]);
        }else{
              return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);
        }
      }

      public function totalData()
      {
          $totalUsers = User::count();
          return view('dahsboard.admins.index', compact('totalUsers'));
      }
      public function showTag()
      {
          $showTag = Tag::all();
          return view('dahsboard.admins.index', compact('showTag'));
      }
    // public function totalData($id)
    // {
    //     $count = User::where('id', $id)->count();
    //     return view("dahsboard.admins.index", compact("count"));
    // }

    public function userOnlineStatus()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id)) {
                echo $user->name . "is online. last seen: " . Carbon::parse($user->last_seen)->diffForHumans(). "<br>";
            } else {
                echo $user->name . "is offline. last seen: ". Carbon::parse($user->last_seen)->diffForHumans(). "<br>";
            }
        }

        // dd($user);
        return view('dahsboard.admins.index', compact('users'));
    }

    public function updatePicture(Request $request)
    {
        $path = 'users/images/';
        $file = $request->file('admin_image');
        $new_name = 'UIMG_'.date('Ymd').uniqid().'.jpg';

        // Upload new images
        $upload = $file->move(public_path($path), $new_name);

        if(!$upload){
            return response()->json(['status'=>0, 'msg'=>'Something went wrong, upload new picture failed.']);
        }else{
            // Get old picture
            $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];

            if($oldPicture !=''){
                if(\File::exists(public_path($path.$oldPicture))){
                    \File::delete(public_path($path.$oldPicture));
                }
            }
            // Update DB
            $update = User::find(Auth::user()->id)->update(['picture'=>$new_name]);

            if(!$upload){
                return response()->json(['status'=>0, 'msg'=>'Something went wrong, updating picture in db failed']);
            }else{
                return response()->json(['status'=>1, 'msg'=>'Your profile picture has been updated successfully']);
            }
        }

    }
}
