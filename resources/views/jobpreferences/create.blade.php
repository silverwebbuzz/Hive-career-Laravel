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
                        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Form/</span>Add Job Preferences Details</h4>

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
                                    <form action="{{route('job-post.store')}}" method="post">
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
                                            <input type="text" name="postname" class="form-control" id="postname" placeholder="Post Name" />
                                            @if ($errors->has('postname'))
                                            <span class="text-danger">{{ $errors->first('postname') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="postdescription">Post Description</label>
                                            <input type="text" name="postdescription" class="form-control" id="postdescription" placeholder="Post Description" />
                                            @if ($errors->has('postdescription'))
                                            <span class="text-danger">{{ $errors->first('postdescription') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Employment Type</label>
                                            <select id="employmenttype" name="employmenttype" class="form-select">
                                                <option>Select</option>
                                                <option value="Full Time">Full Time</option>
                                                <option value="Part Time">Part Time</option>
                                                <option value="Both">Both</option>
                                            </select>
                                            @if ($errors->has('employmenttype'))
                                            <span class="text-danger">{{ $errors->first('employmenttype') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Job Type</label>
                                            <select id="jobtype" name="jobtype" class="form-select">
                                                <option>Select</option>
                                                <option value="Permanent">Permanent</option>
                                                <option value="Temporary">Temporary</option>
                                                <option value="Contract">Contract</option>
                                                <option value="Any">Any</option>
                                            </select>
                                            @if ($errors->has('jobtype'))
                                            <span class="text-danger">{{ $errors->first('jobtype') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Work Mode</label>
                                            <select id="workmode" name="workmode" class="form-select">
                                                <option>Select</option>
                                                <option value="Office">Office</option>
                                                <option value="Remote">Remote</option>
                                                <option value="Hybrid">Hybrid</option>
                                                <option value="OnClient Site">On Client Site</option>
                                                <option value="Any">Any</option>
                                            </select>
                                            @if ($errors->has('workmode'))
                                            <span class="text-danger">{{ $errors->first('workmode') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Shift</label>
                                            <select id="shift" name="shift" class="form-select">
                                                <option>Select</option>
                                                <option value="Day">Day</option>
                                                <option value="Night">Night</option>
                                                <option value="Rotating">Rotating</option>
                                                <option value="Any">Any</option>
                                            </select>
                                            @if ($errors->has('shift'))
                                            <span class="text-danger">{{ $errors->first('shift') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Notice Period</label>
                                            <select id="noticeperiod" name="noticeperiod" class="form-select">
                                                <option>Select</option>
                                                <option value="Immediately">Immediately</option>
                                                <option value="5 Days">5 Days</option>
                                                <option value="15 Days">15 Days</option>
                                                <option value="30 Days">30 Days</option>
                                                <option value="45 Days">45 Days</option>
                                                <option value="60 Days">60 Days</option>
                                                <option value="90 Days">90 Days</option>
                                            </select>
                                            @if ($errors->has('noticeperiod'))
                                            <span class="text-danger">{{ $errors->first('noticeperiod') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Preferred Location</label>
                                            <input type="text" name="preferredlocation" class="form-control" id="preferredlocation" placeholder="Preferred Location" />
                                            @if ($errors->has('preferredlocation'))
                                            <span class="text-danger">{{ $errors->first('preferredlocation') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Skill Tags</label>
                                            <input type="text" name="skilltags" class="form-control" id="skilltags" placeholder="Skill Tags" />
                                            @if ($errors->has('skilltags'))
                                            <span class="text-danger">{{ $errors->first('skilltags') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Salry Mode</label>
                                            <select id="salarymode" name="salarymode" class="form-select">
                                                <option value="Office">Select</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Annually">Annually</option>
                                            </select>
                                            @if ($errors->has('salarymode'))
                                            <span class="text-danger">{{ $errors->first('salarymode') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Currency</label>
                                            <input type="text" name="currency" class="form-control" id="currency" placeholder="Currency" />
                                            @if ($errors->has('currency'))
                                            <span class="text-danger">{{ $errors->first('currency') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Lakhs Form</label>
                                            <input type="text" name="lakhsform" class="form-control" id="lakhsform" placeholder="Lakhs Form" />
                                            @if ($errors->has('lakhsform'))
                                            <span class="text-danger">{{ $errors->first('lakhsform') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Thousand Form</label>
                                            <input type="text" name="thousandform" class="form-control" id="thousandform" placeholder="Thousand Form" />
                                            @if ($errors->has('thousandform'))
                                            <span class="text-danger">{{ $errors->first('thousandform') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Monthly Sal Form</label>
                                            <input type="text" name="monthlysalform" class="form-control" id="monthlysalform" placeholder="Monthly Sal Form" />
                                            @if ($errors->has('monthlysalform'))
                                            <span class="text-danger">{{ $errors->first('monthlysalform') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Yearly Sal Form</label>
                                            <input type="text" name="yearlysalform" class="form-control" id="yearlysalform" placeholder="Yearly Sal Form" />
                                            @if ($errors->has('yearlysalform'))
                                            <span class="text-danger">{{ $errors->first('yearlysalform') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Lakhs To</label>
                                            <input type="text" name="lakhsto" class="form-control" id="lakhsto" placeholder="Lakhs To" />
                                            @if ($errors->has('lakhsto'))
                                            <span class="text-danger">{{ $errors->first('lakhsto') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Thousand To</label>
                                            <input type="text" name="thousandto" class="form-control" id="thousandto" placeholder="Thousand To" />
                                            @if ($errors->has('thousandto'))
                                            <span class="text-danger">{{ $errors->first('thousandto') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Monthly Sal To</label>
                                            <input type="text" name="monthlysalto" class="form-control" id="monthlysalto" placeholder="Monthly Sal To" />
                                            @if ($errors->has('monthlysalto'))
                                            <span class="text-danger">{{ $errors->first('monthlysalto') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Yearly Sal To</label>
                                            <input type="text" name="yearlysalto" class="form-control" id="yearlysalto" placeholder="Yearly Sal To" />
                                            @if ($errors->has('yearlysalto'))
                                            <span class="text-danger">{{ $errors->first('yearlysalto') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">Working Days</label>
                                            <select id="workingday" name="workingday" class="form-select">
                                                <option>Select</option>
                                                <option value="5">5 Days</option>
                                                <option value="6">6 Days</option>
                                                <option value="Both">Both</option>
                                            </select>
                                            @if ($errors->has('workingday'))
                                            <span class="text-danger">{{ $errors->first('workingday') }}</span>
                                            @endif
                                        </div>
                                        <button type="submit" value="submit" class="btn btn-primary">Send</button>
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
