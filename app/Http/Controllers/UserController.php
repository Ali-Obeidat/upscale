<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index(){
        $users= User::all();
        $roles = Role::all(); 
       return view('admin.users.index',compact('users','roles'));
    }
    public function show(User $user){
        $roles = Role::all(); 

       return view('admin.users.profile',compact('user','roles'));
    }
    public function update(User $user){


        $inputs = request()->validate([

            'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'email', 'max:255'],
            'avatar'=> ['file']

        ]);

        if(request('avatar')){
            $inputs['avatar'] = request('avatar')->store('images');
        }

        $user->update($inputs);

        return back();
    }
    public function attachRole(Role $role , $id){

        $user = User::find($id);
        $user->roles()->attach($role);
        return back();
    //    return $role;
    }
    public function detachRole(Role $role , $id){

        //    return $role;
        $user = User::find($id);
        $user->roles()->detach($role);
        return back();
    }

    public function destroy( $id){

        $user = User::find($id);
        $user->delete();

        session()->flash('user-deleted', 'User has been deleted');

        return back();


    }
    
}
