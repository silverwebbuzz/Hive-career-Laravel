<?php

namespace App\Http\Controllers\jobpreferences;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\CompanyJobPreferences;
use App\Models\Companies;
use App\Models\MasterIndustries;
use App\Models\MasterJobCategory;
use App\Models\MasterRole;
use Illuminate\Http\Request;

class JobPreferencesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyjobpreferences = CompanyJobPreferences::with('Companies','MasterIndustries','MasterJobCategory','masterroles')->get();
        // dd($companyjobpreferences);
        return view('jobpreferences.list',compact('companyjobpreferences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Companies::get();
        $masterindustries = MasterIndustries::get();
        $masterjobcategory = MasterJobCategory::get();
        $masterrole = MasterRole::get();

        return view('jobpreferences.create',compact('companies','masterindustries','masterjobcategory','masterrole'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'companyname'=>'required',
            'industriename'=>'required',
            'categoryname'=>'required',
            'rollname'=>'required',
            'postname'=>'required',
            'postdescription'=>'required',
            'employmenttype'=>'required',
            'jobtype'=>'required',
            'workmode'=>'required',
            'shift'=>'required',
            'noticeperiod'=>'required',
            'preferredlocation'=>'required',
            'skilltags'=>'required',
            'salarymode'=>'required',
            'currency'=>'required',
            'lakhsform'=>'required',
            'thousandform'=>'required',
            'monthlysalform'=>'required',
            'yearlysalform'=>'required',
            'lakhsto'=>'required',
            'thousandto'=>'required',
            'monthlysalto'=>'required',
            'yearlysalto'=>'required',
            'workingday'=>'required',
        ]);
        
        
        $jobpreferences = new CompanyJobPreferences();
        $jobpreferences->Com_Id = $request->companyname;
        $jobpreferences->I_Id = $request->industriename;
        $jobpreferences->C_Id = $request->categoryname;
        $jobpreferences->R_Id = $request->rollname;
        $jobpreferences->PostName = $request->postname;
        $jobpreferences->PostDescription = $request->postdescription;
        $jobpreferences->EmploymentType	 = $request->employmenttype;
        $jobpreferences->JobType = $request->jobtype;
        $jobpreferences->WorkMode = $request->workmode;
        $jobpreferences->Shift = $request->shift;
        $jobpreferences->NoticePeriod = $request->noticeperiod;
        $jobpreferences->PreferredLocation = $request->preferredlocation;
        $jobpreferences->SkillTags = $request->skilltags;
        $jobpreferences->SalaryMode = $request->salarymode;
        $jobpreferences->Currency = $request->currency;
        $jobpreferences->LakhsFrom = $request->lakhsform;
        $jobpreferences->ThousandFrom = $request->thousandform;
        $jobpreferences->MonthlySalFrom = $request->monthlysalform;
        $jobpreferences->YearlySalFrom = $request->yearlysalform;
        $jobpreferences->LakhsTo = $request->lakhsto;
        $jobpreferences->ThousandTo = $request->thousandto;
        $jobpreferences->MonthlySalTo = $request->monthlysalto;
        $jobpreferences->YearlySalTo = $request->yearlysalto;
        $jobpreferences->WorkingDays = $request->workingday;
        $jobpreferences->save();
        session()->flash('success', 'Your job post has been add successfully.');
        return redirect()->route('job-post.index');
        // }
        // echo "<pre>";print_r("status 0");die;
    }

    // public function storeJob(Request $request)
    // {
    //     $request->validate([
    //         'companyname'=>'required',
    //         'industriename'=>'required',
    //         'categoryname'=>'required',
    //         'rollname'=>'required',
    //         'employmenttype'=>'required',
    //         'jobtype'=>'required',
    //         'workmode'=>'required',
    //         'shift'=>'required',
    //         'noticeperiod'=>'required',
    //         'preferredlocation'=>'required',
    //         'skilltags'=>'required',
    //         'salarymode'=>'required',
    //         'currency'=>'required',
    //         'lakhsform'=>'required',
    //         'thousandform'=>'required',
    //         'monthlysalform'=>'required',
    //         'yearlysalform'=>'required',
    //         'lakhsto'=>'required',
    //         'thousandto'=>'required',
    //         'monthlysalto'=>'required',
    //         'yearlysalto'=>'required',
    //         'workingday'=>'required',
    //     ]);
    //     dd($companies);
        
    //     $companies = Companies::get()->first();
        
    //     $jobpreferences = new CompanyJobPreferences();
    //     $jobpreferences->Com_Id = $request->companyname;
    //     $jobpreferences->I_Id = $request->industriename;
    //     $jobpreferences->C_Id = $request->categoryname;
    //     $jobpreferences->R_Id = $request->rollname;
    //     $jobpreferences->EmploymentType	 = $request->employmenttype;
    //     $jobpreferences->JobType = $request->jobtype;
    //     $jobpreferences->WorkMode	 = $request->workmode;
    //     $jobpreferences->Shift = $request->shift;
    //     $jobpreferences->NoticePeriod = $request->noticeperiod;
    //     $jobpreferences->PreferredLocation = $request->preferredlocation;
    //     $jobpreferences->SkillTags = $request->skilltags;
    //     $jobpreferences->SalaryMode = $request->salarymode;
    //     $jobpreferences->Currency = $request->currency;
    //     $jobpreferences->LakhsFrom = $request->lakhsform;
    //     $jobpreferences->ThousandFrom = $request->thousandform;
    //     $jobpreferences->MonthlySalFrom = $request->monthlysalform;
    //     $jobpreferences->YearlySalFrom = $request->yearlysalform;
    //     $jobpreferences->LakhsTo = $request->lakhsto;
    //     $jobpreferences->ThousandTo = $request->thousandto;
    //     $jobpreferences->MonthlySalTo = $request->monthlysalto;
    //     $jobpreferences->YearlySalTo = $request->yearlysalto;
    //     $jobpreferences->WorkingDays = $request->workingday;
    //     $jobpreferences->save();
        
    //     return redirect()->route('job-post.index');
    // }

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
        $companies = Companies::get();
        $masterindustries = MasterIndustries::get();
        $masterjobcategory = MasterJobCategory::get();
        $masterrole = MasterRole::get(); 
        $companyjobpreferences = CompanyJobPreferences::find($id);
        // dd($companyjobpreferences);
        return view('jobpreferences.edit',compact('companies','masterindustries','masterjobcategory','masterrole','companyjobpreferences'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'companyname'=>'required',
            'industriename'=>'required',
            'categoryname'=>'required',
            'rollname'=>'required',
            'postname'=>'required',
            'postdescription'=>'required',
            'employmenttype'=>'required',
            'jobtype'=>'required',
            'workmode'=>'required',
            'shift'=>'required',
            'noticeperiod'=>'required',
            'preferredlocation'=>'required',
            'skilltags'=>'required',
            'salarymode'=>'required',
            'currency'=>'required',
            'lakhsform'=>'required',
            'thousandform'=>'required',
            'monthlysalform'=>'required',
            'yearlysalform'=>'required',
            'lakhsto'=>'required',
            'thousandto'=>'required',
            'monthlysalto'=>'required',
            'yearlysalto'=>'required',
            'workingday'=>'required',
        ]);

        $jobpreferences = CompanyJobPreferences::find($id);
        $jobpreferences->Com_Id = $request->companyname;
        $jobpreferences->I_Id = $request->industriename;
        $jobpreferences->C_Id = $request->categoryname;
        $jobpreferences->R_Id = $request->rollname;
        $jobpreferences->PostName = $request->postname;
        $jobpreferences->PostDescription = $request->postdescription;
        $jobpreferences->EmploymentType	 = $request->employmenttype;
        $jobpreferences->JobType = $request->jobtype;
        $jobpreferences->WorkMode	 = $request->workmode;
        $jobpreferences->Shift = $request->shift;
        $jobpreferences->NoticePeriod = $request->noticeperiod;
        $jobpreferences->PreferredLocation = $request->preferredlocation;
        $jobpreferences->SkillTags = $request->skilltags;
        $jobpreferences->SalaryMode = $request->salarymode;
        $jobpreferences->Currency = $request->currency;
        $jobpreferences->LakhsFrom = $request->lakhsform;
        $jobpreferences->ThousandFrom = $request->thousandform;
        $jobpreferences->MonthlySalFrom = $request->monthlysalform;
        $jobpreferences->YearlySalFrom = $request->yearlysalform;
        $jobpreferences->LakhsTo = $request->lakhsto;
        $jobpreferences->ThousandTo = $request->thousandto;
        $jobpreferences->MonthlySalTo = $request->monthlysalto;
        $jobpreferences->YearlySalTo = $request->yearlysalto;
        $jobpreferences->WorkingDays = $request->workingday;
        $jobpreferences->save();
        session()->flash('success', 'Your job post has been update successfully.');
        return redirect()->route('job-post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $jobpreferences = CompanyJobPreferences::find($id);
        $jobpreferences->delete();
        return redirect()->back();
    }
}