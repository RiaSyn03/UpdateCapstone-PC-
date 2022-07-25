<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $numusers = User::count();
        $userid = User::sum('year');
        $ave = User::avg('year');
        return view('admin.users.index', compact('users', 'numusers', 'userid', 'ave'));
    
}

    public function create(Request $request)
    {
    $request->validate([
        'idnum'=>'required',
        'fname'=>'required',
        'mname'=>'required',
        'lname'=>'required',
        'course'=>'required',
        'year'=>'required',
        'email'=>'required|email',
        'password'=>'required', 
        
    ]);
    $user = User::create([
        'idnum'=> $request->idnum,
        'fname'=> $request->fname,
        'mname'=> $request->mname,
        'lname'=> $request->lname,
        'course'=> $request->course,
        'year'=> $request->year,
        'email'=> $request->email,
        'password'=>bcrypt($request->password)

    ]);
    
    if ($request->has('role')){
        $user->assignRole($request->role['name']);
    }

    if ($request->has('permissions')){
        $user->givePermissionTo(collect($request->permissions)->pluck('id')->toArray());
    }
    // return response(['message'=>'User Created', 'user'=>$user]);
    return redirect()->route('index')->with('success','Student Added');
    
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->id == $id){
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit yourself.');
        }

        return view('admin.users.edit')->with(['user'=>User::find($id), 'roles'=>Role::all()]);
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
        if(Auth::user()->id == $id){
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit yourself.');
       }

       $user = User::find($id);
       $user->roles()->sync($request->roles);

       return redirect()->route('admin.users.index')->with('success', 'Users has been updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id == $id){
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to delete yourself.');
       }

       
       $user = User::find($id);
       if($user){
           $user->roles()->detach();
           $user->delete();
           return redirect()->route('admin.users.index')->with('success', 'Users has been deleted');
       }
       return redirect()->route('admin.users.index')->with('warning', 'This user cannot be deleted');
    }
}

