<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
    {
        return view('dahsboard.users.index');
    }

    public function profile()
    {
        return view('dahsboard.users.profile');
    }
    public function settings()
    {
        return view('dahsboard.users.settings');
    }

    public function updateUser(Request $request)
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

    public function updatePicture(Request $request)
    {
        $path = 'users/images/';
        $file = $request->file('user_image');
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
