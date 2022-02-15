<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->userHasRole('super admin')){

            $employees = User::with('company')->where('id','!=',1)->paginate(5);
            return view('admin.employees.index',compact('employees'));
        }elseif (Auth::user()->userHasRole('company admin')) {
            $employees = User::with('company')->where('id','!=',1) ->where('company_id',Auth::user()->company_id )->paginate(5);

            return view('admin.employees.index',compact('employees'));

        }
        
        // return $employees[0]->roles[0]->name;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        if(Auth::user()->userHasRole('super admin')){

            $companies= Company::all();
            $roles= Role::all();
            return view('admin.employees.create',compact('companies','roles'));
        }elseif (Auth::user()->userHasRole('company admin')) {
            $comp= Company::where('id',Auth::user()->company_id )->get();
            $role= Role::where('name','employee')->get();
            // $company= Company::all();
            // return $role[0]->id;
            return view('admin.employees.create',compact('comp','role'));

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $input= $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'company_id'=>'required',
            'password'=>'required'
            
        ]);

     
        User:: create($input);
        $user = User::all()->last();
        // return $user;
        $user->roles()->attach($request['Type']);
        // Session::flash('post_create_massage','post was created');
        session()->flash('User_create_massage','Employee was created');

        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User:: findOrFail($id);
        $roles = Role::all(); 
        // return $roles;
        return view('admin.roles.edit',compact('user','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id )
    {
        $Employee= User::findOrFail($id);
        $companies= Company::all();
        $roles= Role::all();
        return view('admin.employees.edit',compact('Employee','companies','roles'));
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
        $input= $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'company_id'=>'required',
            'password'=>''
            
        ]);

        $Employee = User::findOrFail($id);
        $Employee->update($input);
        $Employee->roles()->attach($request['Type']);
        // Session::flash('post_create_massage','post was created');
        session()->flash('User_update_massage','Employee was updated');

        return redirect()->route('employees.index');
    }
    public function attachRole(Role $role , $id){

        //    return $role;
        $user = User::find($id);
        $user->roles()->attach($role);
        return back();
    }
    public function detachRole(Role $role , $id){

        //    return $role;
        $user = User::find($id);
        $user->roles()->detach($role);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Employee = User::findOrFail($id);
        $Employee-> delete();
       Session()->flash('massage','Employee was deleted');
       
        return back();
    }
}
