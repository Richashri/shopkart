<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Session;
use App\Admin;

class AdminController extends Controller
{
    
     //
    public function dashboard()
    {
        
        return view('admin.dashboard');
    }
    
    public function settings()
    {
        $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        return view('admin.settings')->with(compact('admin'));
    }

    public function check_current_pwd(Request $request)
    {
        $data = $request->all();        
        $admin_pwd = Auth::guard('admin')->user()->password;

        if(Hash::check($data['curPwd'], $admin_pwd)){
            echo "true";
        }else{
            echo "false";
        }

    }

    public function update_pwd(Request $request)
    {
        $data = $request->all();
        $admin = Auth::guard('admin')->user();
        $admin_pwd = $admin->password;
        $admin_id = $admin->id;
       
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8'
        ]);

        if(Hash::check($data['current_password'], $admin_pwd)){
            if(!Hash::check($data['new_password'], $admin_pwd)){
                Admin::where('id', $admin_id)->update(['password' => bcrypt($data['new_password'])]);
                Session::flash('success_message', 'You are using new password as Current Password!');
                return redirect()->back();
            }else{
                Session::flash('error_message', 'You are using same password same!');
                return redirect()->back();
            }
        }else{
            Session::flash('error_message', 'Your Current Password is Wrong!');
            return redirect()->back();
        }

    }

    public function admin_other_settings(Request $request)
    {
        $data = $request->all();
        $admin = Auth::guard('admin')->user();
        $admin_id = $admin->id;
        $file_name = ($admin->image != '') ? $admin->image : '';
        $env_admin_img_path = env('IMG_ADMIN_PATH');
        
        $validatedData = $request->validate([
            'admin_name' => 'required|max:50',
            'mobile' => 'required|numeric',
            'image' => 'image|max:512'
        ]);
        
        
        if($request->hasfile('image')){
            $file = $request->file('image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'admin_ava'.uniqid().'.'.$file_ext;
            $file->move($env_admin_img_path, $file_name);
        }

        Admin::where('id', $admin_id)->update([
            'name' => $data['admin_name'],
            'mobile' => $data['mobile'],
            'image' => $file_name
        ]);
        
        $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        Session::flash('success_message_s', 'Admin info is successfully updated!');

        return redirect()->back()->with(compact('admin')); 

    }

    //
    public function login(Request $request)
    {        
        if($request->isMethod('post')){

            $validatedData = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

            $data = $request->all();
            
            if(Auth::guard('admin')->attempt(['email' => $data['email'] , 'password' => $data['password']])){
                return redirect('admin/dashboard');
            }else{
                Session::flash('error_message', 'Invalid Email or Password.');
                return redirect()->back();
            }
        }
        
        return view('admin.login');
    }

    public function logout(Request $request)
    {        
        Auth::guard('admin')->logout();
        
        return redirect('/admin');
    }
}
