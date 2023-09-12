<?php

namespace App\Http\Controllers\conpanypakages;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\MasterPakage;
use App\Models\CompaniesPakage;
use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesPakagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $companiepakageList = CompaniesPakage::with('Companies','MasterPakage')->get();
        // dd($companiepakageList);
        return view('companypakage.list',compact('companiepakageList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companieslist = Companies::get();
        $masterpakagelist = MasterPakage::get();
        // dd($masterpakagelist);
        return view('companypakage.create',compact('companieslist','masterpakagelist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'companyname'=>'required',
            'pakagename'=>'required',
            'startdate'=>'required',
            'enddate'=>'required',
            'autorewnew'=>'required',
            'status'=>'required',
        ]);

        $companiepakage = new CompaniesPakage();
        $companiepakage->Com_Id = $request->companyname;
        $companiepakage->P_Id = $request->pakagename;
        $companiepakage->startDate = $request->startdate;
        $companiepakage->endDate = $request->enddate;
        $companiepakage->autoRenew = $request->autorewnew;
        $companiepakage->status = $request->status;
        $companiepakage->save();
        session()->flash('success', 'Your Companies pakages has been add successfully.');
        return redirect()->route('company-pakage.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $companieslist = Companies::get();
        $masterpakagelist = MasterPakage::get();
        $companiespakages = CompaniesPakage::find($id);
        // dd($companiespakages);
        return view('companypakage.edit',compact('companieslist','masterpakagelist','companiespakages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'companyname'=>'required',
            'pakagename'=>'required',
            'startdate'=>'required',
            'enddate'=>'required',
            'autorewnew'=>'required',
            'status'=>'required',
        ]);

        $companiepakage = CompaniesPakage::find($id);
        $companiepakage->Com_Id = $request->companyname;
        $companiepakage->P_Id = (int)$request->pakagename;
        $companiepakage->startDate = $request->startdate;
        $companiepakage->endDate = $request->enddate;
        $companiepakage->autoRenew = $request->autorewnew;
        $companiepakage->status = $request->status;
        $companiepakage->save();
        session()->flash('success', 'Your Companies pakages has been update successfully.');
        return redirect()->route('company-pakage.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $companiepakage = CompaniesPakage::find($id);
        $companiepakage->delete();
        return redirect()->back();
    }
}