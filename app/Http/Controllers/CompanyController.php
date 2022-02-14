<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $companies = Company::paginate(5);
       return  view('admin.companies.index',compact('companies') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
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
            'email'=> '',
            'logo'=>'file',
            'website'=>''
            
        ]);

        if (request('logo')) {
            $input['logo']= request('logo')->store('images');
        }
        Company:: create($input);
        // Session::flash('post_create_massage','post was created');
        session()->flash('Company_create_massage','Company was created');

        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Company= Company::findOrFail($id);
        return view('admin.companies.edit',compact('Company'));
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
            'email'=> '',
            'logo'=>'file',
            'website'=>''
            
        ]);

        if (request('logo')) {
            $input['logo']= request('logo')->store('images');
        }
        $company = Company::findOrFail($id);
        $company->update($input);
        session()->flash('company_updated_massage','company was updated');

        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company-> delete();
       Session()->flash('massage','Company was deleted');
       
        return back();
    }
}
