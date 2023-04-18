<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
         $companies = Company::orderBy('id','desc')->paginate(10);

        return view('dashboard.company.index', compact('companies'));
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            // 'email' => 'required',
            // 'website' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        // |min:100x100
        $input = $request->all();

        if ($image = $request->file('logo')) {
            $destinationPath = 'images/logos/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['logo'] = "$profileImage";
        }
   

        // print_r($input);
        // dd($request);
        Company::create($input);

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully.');
    }
     /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Company  $movie
    * @return \Illuminate\Http\Response
    */
    public function edit(Request $request)
    {
        // dd($request['id']);
        
        $company=DB::table('companies')
        ->select('*')
        ->where('id','=',$request['id'])
        ->get();
       
        $company=$company[0];
        // $company = Company::findOrFail($request['id'])->where('id',$request['id'])->paginate(1);
        // dd($company[0]);
        return view('dashboard.company.edit',compact('company'));
    }
       /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'website' => 'required',
            

        ]);
        $input = $request->all();

        if($request->file('logo')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('images/logos'), $filename);
            $input['logo']= $filename;
        }else{
            unset($input['logo']);
        }
        $company->fill($input)->save();
  
        return redirect()->route('companies.index')
        ->with('success', 'Company updated successfully.');   
     }


           /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company has been deleted successfully');
    }

}
