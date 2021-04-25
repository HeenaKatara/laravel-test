<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminController extends Controller
{
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('is_admin','!=',1)->get();
        return view('admin.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'dob' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
  
        $input = $request->all();
        $input = request()->except(['_token','password_confirmation']);
        
        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'dob' => $request->dob,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
     
        return redirect()->route('admin.index')
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
        return view('admin.edit',compact('user'));
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
  
        $updateData = User::where('id',$id)->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'dob' => $request->dob,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('admin.index')
                        ->with('success','user updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::where('id',$id)->delete();
     
        return redirect()->route('admin.index')
                        ->with('success','user deleted successfully');
    }
}
