<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class UserController extends Controller
{
   

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
    	$users = User::where('id',$user_id)->where('is_admin',0)->get();
        
        return view('users.index',compact('users'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'firstname' => 'required',
            'lastname' => 'required',
            'company' => 'required',
            'job_title' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'nickname' => 'required',
            'birthdate' => 'required',
            'address' => 'required',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $request->all();

        
        if ($image = $request->file('profile')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['profile'] = $profileImage;
        }
    
        User::create($input);
     
        return redirect()->route('users.index')
                        ->with('success','user created successfully.');
    }
    
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();
         //echo "<pre>"; print_r($id); exit;
        return view('users.edit',compact('user'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
    	
        $input = request()->except(['_token','password_confirmation']);

        $password = User::where('id',$id)->select('password')->first();

        if($request->password == $password['password']){
            $password = $request->password;
        }  else {
            $password = Hash::make($request->password);
        }
        
        $updateData = User::where('id',$id)->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'dob' => $request->dob,
            'email' => $request->email,
            'password' => $password,
        ]);
    
        return redirect()->route('users.index')
                        ->with('success','user updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\ResponseshowLoginForm
     */
    public function destroy($id)
    {
        $delete = User::where('id',$id)->delete();
     
        return redirect()->route('users.index')
                        ->with('success','user deleted successfully');
    }
    
}
