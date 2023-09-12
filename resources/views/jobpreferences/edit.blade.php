@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/commonMaster' )

@php
/* Display elements */
$contentNavbar = ($contentNavbar ?? true);
$containerNav = ($containerNav ?? 'container-xxl');
$isNavbar = ($isNavbar ?? true);
$isMenu = ($isMenu ?? true);
$isFlex = ($isFlex ?? false);
$isFooter = ($isFooter ?? true);
$customizerHidden = ($customizerHidden ?? '');
$pricingModal = ($pricingModal ?? false);

/* HTML Classes */
$navbarDetached = 'navbar-detached';
$menuFixed = (isset($configData['menuFixed']) ? $configData['menuFixed'] : '');
if(isset($navbarType)) {
$configData['navbarType'] = $navbarType;
}
$navbarType = (isset($configData['navbarType']) ? $configData['navbarType'] : '');
$footerFixed = (isset($configData['footerFixed']) ? $configData['footerFixed'] : '');
$menuCollapsed = (isset($configData['menuCollapsed']) ? $configData['menuCollapsed'] : '');

/* Content classes */
$container = (isset($configData['contentLayout']) && $configData['contentLayout'] === 'compact') ? 'container-xxl' : 'container-fluid';

@endphp

@section('layoutContent')
<div class="layout-wrapper layout-content-navbar {{ $isMenu ? '' : 'layout-without-menu' }}">
    <div class="layout-container">

        @if ($isMenu)
        @include('layouts/sections/menu/verticalMenu')
        @endif


        <!-- Layout page -->
        <div class="layout-page">

            {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream. --}}
            {{-- <x-banner /> --}}

            <!-- BEGIN: Navbar-->
            @if ($isNavbar)
            @include('layouts/sections/navbar/navbar')
            @endif
            <!-- END: Navbar-->


            <!-- Content wrapper -->
            <div class="content-wrapper">

                <!-- Content -->
                @if ($isFlex)
                <div class="{{$container}} d-flex align-items-stretch flex-grow-1 p-0">
                    @else
                    <div class="{{$container}} flex-grow-1 container-p-y">
                        @endif

                        @yield('content')

                        <!-- pricingModal -->
                        @if ($pricingModal)
                        @include('_partials/_modals/modal-pricing')
                        @endif
                        <!--/ pricingModal -->
                        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Form/</span>Update Job Preferences Details</h4>

                        {{-- create  --}}
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Job Preferences</h5>
                                </div>
                                <div class="card-body">
                                    @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                        @php
                                        Session::forget('success');
                                        @endphp

                                    </div>

                                    @endif
                                    <form action="{{route('job-post.update',$companyjobpreferences->CJP_Id)}}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Company Name</label>
                                            <select id="companyname" name="companyname" class="form-select">
                                                <option>Select</option>
                                                @foreach($companies as $company)
                                                <option value="{{$company->Com_Id}}">{{$company->CompanyName}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('companyname'))
                                            <span class="text-danger">{{ $errors->first('companyname') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Industrie Name</label>
                                            <select id="industriename" name="industriename" class="form-select">
                                                <option>Select</option>
                                                @foreach($masterindustries as $industrie)
                                                <option value="{{$industrie->I_Id}}">{{$industrie->Iname}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('industriename'))
                                            <span class="text-danger">{{ $errors->first('industriename') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Category Name</label>
                                            <select id="categoryname" name="categoryname" class="form-select">
                                                <option>Select</option>
                                                @foreach($masterjobcategory as $jobcategory)
                                                <option value="{{$jobcategory->C_Id}}">{{$jobcategory->Cname}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('categoryname'))
                                            <span class="text-danger">{{ $errors->first('categoryname') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Role Name</label>
                                            <select id="rollname" name="rollname" class="form-select">
                                                <option>Select</option>
                                                @foreach($masterrole as $roles)
                                                <option value="{{$roles->R_Id}}">{{$roles->Rname}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('rollname'))
                                            <span class="text-danger">{{ $errors->first('rollname') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="postname">Post Name</label>
                                            <input type="text" name="postname" class="form-control" id="postname" value="{{$companyjobpreferences->PostName}}" placeholder="Post Name" />
                                            @if ($errors->has('postname'))
                                            <span class="text-danger">{{ $errors->first('postname') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="postdescription">Post Description</label>
                                            <input type="text" name="postdescription" class="form-control" id="postdescription" value="{{$companyjobpreferences->PostDescription}}" placeholder="Post Description" />
                                            @if ($errors->has('postdescription'))
                                            <span class="text-danger">{{ $errors->first('postdescription') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Employment Type</label>
                                            <select id="employmenttype" name="employmenttype" class="form-select">
                                                <option>Select</option>
                                                <option value="Full Time" @if($companyjobpreferences->EmploymentType === 'Full Time') selected @endif>Full Time</option>
                                                <option value="Full Time" @if($companyjobpreferences->EmploymentType === 'Part Time') selected @endif>Part Time</option>
                                                <option value="Full Time" @if($companyjobpreferences->EmploymentType === 'Both') selected @endif>Both</option>
                                            </select>
                                            @if ($errors->has('employmenttype'))
                                            <span class="text-danger">{{ $errors->first('employmenttype') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Job Type</label>
                                            <select id="jobtype" name="jobtype" class="form-select">
                                                <option>Select</option>
                                                <option value="Permanente" @if($companyjobpreferences->JobType === 'Permanent') selected @endif>Permanent</option>
                                                <option value="Temporary" @if($companyjobpreferences->JobType === 'Temporary') selected @endif>Temporary</option>
                                                <option value="Contract" @if($companyjobpreferences->JobType === 'Contract') selected @endif>Contract</option>
                                                <option value="Any" @if($companyjobpreferences->JobType === 'Any') selected @endif>Any</option>
                                            </select>
                                            @if ($errors->has('jobtype'))
                                            <span class="text-danger">{{ $errors->first('jobtype') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Work Mode</label>
                                            <select id="workmode" name="workmode" class="form-select">
                                                <option>Select</option>
                                                <option value="Office" @if($companyjobpreferences->WorkMode === 'Office') selected @endif>Office</option>
                                                <option value="Remote" @if($companyjobpreferences->WorkMode === 'Remote') selected @endif>Remote</option>
                                                <option value="Hybrid" @if($companyjobpreferences->WorkMode === 'Hybrid') selected @endif>Hybrid</option>
                                                <option value="OnClient Site" @if($companyjobpreferences->WorkMode === 'OnClient Site') selected @endif>On Client Site</option>
                                                <option value="Any" @if($companyjobpreferences->WorkMode === 'Any') selected @endif>Any</option>
                                            </select>
                                            @if ($errors->has('workmode'))
                                            <span class="text-danger">{{ $errors->first('workmode') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Shift</label>
                                            <select id="shift" name="shift" class="form-select">
                                                <option>Select</option>
                                                <option value="Day" @if($companyjobpreferences->Shift === 'Day') selected @endif>Day</option>
                                                <option value="Night" @if($companyjobpreferences->Shift === 'Night') selected @endif>Night</option>
                                                <option value="Rotating" @if($companyjobpreferences->Shift === 'Rotating') selected @endif>Rotating</option>
                                                <option value="Any" @if($companyjobpreferences->Shift === 'Any') selected @endif>Any</option>
                                            </select>
                                            @if ($errors->has('shift'))
                                            <span class="text-danger">{{ $errors->first('shift') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Notice Period</label>
                                            <select id="noticeperiod" name="noticeperiod" class="form-select">
                                                <option>Select</option>
                                                <option value="Immediately" @if($companyjobpreferences->NoticePeriod === 'Immediately') selected @endif>Immediately</option>
                                                <option value="5 Days" @if($companyjobpreferences->NoticePeriod === '5 Days') selected @endif>5 Days</option>
                                                <option value="15 Days" @if($companyjobpreferences->NoticePeriod === '15 Days') selected @endif>15 Days</option>
                                                <option value="30 Days" @if($companyjobpreferences->NoticePeriod === '30 Days') selected @endif>30 Days</option>
                                                <option value="45 Days" @if($companyjobpreferences->NoticePeriod === '45 Days') selected @endif>45 Days</option>
                                                <option value="60 Days" @if($companyjobpreferences->NoticePeriod === '60 Days') selected @endif>60 Days</option>
                                                <option value="90 Days" @if($companyjobpreferences->NoticePeriod === '90 Days') selected @endif>90 Days</option>
                                            </select>
                                            @if ($errors->has('noticeperiod'))
                                            <span class="text-danger">{{ $errors->first('noticeperiod') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Preferred Location</label>
                                            <input type="text" name="preferredlocation" value="{{$companyjobpreferences->PreferredLocation}}" class="form-control" id="preferredlocation" placeholder="Preferred Location" />
                                            @if ($errors->has('preferredlocation'))
                                            <span class="text-danger">{{ $errors->first('preferredlocation') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Skill Tags</label>
                                            <input type="text" name="skilltags" value="{{$companyjobpreferences->SkillTags}}" class="form-control" id="skilltags" placeholder="Skill Tags" />
                                            @if ($errors->has('skilltags'))
                                            <span class="text-danger">{{ $errors->first('skilltags') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Salry Mode</label>
                                            <select id="salarymode" name="salarymode" class="form-select">
                                                <option value="Office" @if($companyjobpreferences->SalaryMode === 'Office') selected @endif>Select</option>
                                                <option value="Monthly" @if($companyjobpreferences->SalaryMode === 'Monthly') selected @endif>Monthly</option>
                                                <option value="Annually" @if($companyjobpreferences->SalaryMode === 'Annually') selected @endif>Annually</option>
                                            </select>
                                            @if ($errors->has('salarymode'))
                                            <span class="text-danger">{{ $errors->first('salarymode') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Currency</label>
                                            <input type="text" name="currency" value="{{$companyjobpreferences->Currency}}" class="form-control" id="currency" placeholder="Currency" />
                                            @if ($errors->has('currency'))
                                            <span class="text-danger">{{ $errors->first('currency') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Lakhs Form</label>
                                            <input type="text" name="lakhsform" value="{{$companyjobpreferences->LakhsFrom}}" class="form-control" id="lakhsform" placeholder="Lakhs Form" />
                                            @if ($errors->has('lakhsform'))
                                            <span class="text-danger">{{ $errors->first('lakhsform') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Thousand Form</label>
                                            <input type="text" name="thousandform" value="{{$companyjobpreferences->ThousandFrom}}" class="form-control" id="thousandform" placeholder="Thousand Form" />
                                            @if ($errors->has('thousandform'))
                                            <span class="text-danger">{{ $errors->first('thousandform') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Monthly Sal Form</label>
                                            <input type="text" name="monthlysalform" value="{{$companyjobpreferences->MonthlySalFrom}}" class="form-control" id="monthlysalform" placeholder="Monthly Sal Form" />
                                            @if ($errors->has('monthlysalform'))
                                            <span class="text-danger">{{ $errors->first('monthlysalform') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Yearly Sal Form</label>
                                            <input type="text" name="yearlysalform" value="{{$companyjobpreferences->YearlySalFrom}}" class="form-control" id="yearlysalform" placeholder="Yearly Sal Form" />
                                            @if ($errors->has('yearlysalform'))
                                            <span class="text-danger">{{ $errors->first('yearlysalform') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Lakhs To</label>
                                            <input type="text" name="lakhsto" class="form-control" value="{{$companyjobpreferences->LakhsTo}}" id="lakhsto" placeholder="Lakhs To" />
                                            @if ($errors->has('lakhsto'))
                                            <span class="text-danger">{{ $errors->first('lakhsto') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Thousand To</label>
                                            <input type="text" name="thousandto" value="{{$companyjobpreferences->ThousandTo}}" class="form-control" id="thousandto" placeholder="Thousand To" />
                                            @if ($errors->has('thousandto'))
                                            <span class="text-danger">{{ $errors->first('thousandto') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Monthly Sal To</label>
                                            <input type="text" name="monthlysalto" value="{{$companyjobpreferences->MonthlySalTo}}" class="form-control" id="monthlysalto" placeholder="Monthly Sal To" />
                                            @if ($errors->has('monthlysalto'))
                                            <span class="text-danger">{{ $errors->first('monthlysalto') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Yearly Sal To</label>
                                            <input type="text" name="yearlysalto" value="{{$companyjobpreferences->YearlySalTo}}" class="form-control" id="yearlysalto" placeholder="Yearly Sal To" />
                                            @if ($errors->has('yearlysalto'))
                                            <span class="text-danger">{{ $errors->first('yearlysalto') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Working Days</label>
                                            <select id="workingday" name="workingday" class="form-select">
                                                <option>Select</option>
                                                <option value="5" @if($companyjobpreferences->WorkingDays === '5') selected @endif>5 Days</option>
                                                <option value="6" @if($companyjobpreferences->WorkingDays === '6') selected @endif>6 Days</option>
                                                <option value="Both" @if($companyjobpreferences->WorkingDays === 'Both') selected @endif>Both</option>
                                            </select>
                                            @if ($errors->has('workingday'))
                                            <span class="text-danger">{{ $errors->first('workingday') }}</span>
                                            @endif
                                        </div>
                                        <button type="submit" value="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{--/ create --}}


                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @if ($isFooter)
                    @include('layouts/sections/footer/footer')
                    @endif
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!--/ Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        @if ($isMenu)
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        @endif
        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
    @endsection
