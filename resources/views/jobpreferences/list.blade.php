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


                        <!--/ jobpreferences table -->
                        {{-- master table --}}
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="card">
                            <h5 class="card-header">Job Post <a href="{{route('job-post.create')}}" class="btn btn-success btn-sm float-end">Create</a></h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Company Name</th>
                                            <th>Industrie Name</th>
                                            <th>Category Name</th>
                                            <th>Roll Name</th>
                                            <th>Post Name</th>
                                            <th>Post Description</th>
                                            <th>Employment Type</th>
                                            <th>Job Type</th>
                                            <th>Work Mode</th>
                                            <th>Shift</th>
                                            <th>Notice Period</th>
                                            <th>Preferred Location</th>
                                            <th>Skill Tags</th>
                                            <th>Salary Mode</th>
                                            <th>Currency</th>
                                            <th>Lakhs From</th>
                                            <th>Thousand Form</th>
                                            <th>Monthly Sal Form</th>
                                            <th>Yearly Sal Form</th>
                                            <th>Lakhs To</th>
                                            <th>Thousand To</th>
                                            <th>Monthly Sal To</th>
                                            <th>Yearly Sal To</th>
                                            <th>Working Days</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse ($companyjobpreferences as $jobpreferences)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$jobpreferences->Companies->CompanyName}}</td>
                                            <td>{{$jobpreferences->MasterIndustries->Iname}}</td>
                                            <td>{{$jobpreferences->MasterJobCategory->Cname}}</td>
                                            <td>{{$jobpreferences->masterroles->Rname}}</td>
                                            <td>{{$jobpreferences->PostName}}</td>
                                            <td>{{$jobpreferences->PostDescription}}</td>
                                            <td>{{$jobpreferences->EmploymentType}}</td>
                                            <td>{{$jobpreferences->JobType}}</td>
                                            <td>{{$jobpreferences->WorkMode}}</td>
                                            <td>{{$jobpreferences->Shift}}</td>
                                            <td>{{$jobpreferences->NoticePeriod}}</td>
                                            <td>{{$jobpreferences->PreferredLocation}}</td>
                                            <td>{{$jobpreferences->SkillTags}}</td>
                                            <td>{{$jobpreferences->SalaryMode}}</td>
                                            <td>{{$jobpreferences->Currency}}</td>
                                            <td>{{$jobpreferences->LakhsFrom}}</td>
                                            <td>{{$jobpreferences->ThousandFrom}}</td>
                                            <td>{{$jobpreferences->MonthlySalFrom}}</td>
                                            <td>{{$jobpreferences->YearlySalFrom}}</td>
                                            <td>{{$jobpreferences->LakhsTo}}</td>
                                            <td>{{$jobpreferences->ThousandTo}}</td>
                                            <td>{{$jobpreferences->MonthlySalTo}}</td>
                                            <td>{{$jobpreferences->YearlySalTo}}</td>
                                            <td>{{$jobpreferences->WorkingDays}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('job-post.edit',$jobpreferences->CJP_Id)}}"><i class="ti ti-pencil me-1"></i> Edit</a>
                                                        <a class="dropdown-item" href="{{route('job-preferences.destroy',$jobpreferences->CJP_Id)}}"><i class="ti ti-trash me-1"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center"> No Record Found !! </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{--/ table --}}
                        <!--/ jobpreferences table -->

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
