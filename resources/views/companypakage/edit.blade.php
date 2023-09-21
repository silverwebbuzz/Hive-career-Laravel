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
                        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Form/</span>Update Companies pakages Details</h4>

                        {{-- create  --}}
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Companies pakages</h5>
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
                                    <form action="{{route('company-pakage.update',$companiespakages->CP_Id)}}" method="post">
                                        @method('put')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">company name</label>
                                            <select id="companyname" name="companyname" class="form-select">
                                                <option>Select</option>
                                                @foreach($companieslist as $company)
                                                <option value="{{$company->Com_Id}}">{{$company->CompanyName}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('companyname'))
                                            <span class="text-danger">{{ $errors->first('companyname') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="Select" class="form-label">pakage name</label>
                                            <select id="pakagename" name="pakagename[]" class="form-select">
                                                <option>Select</option>
                                                @foreach($masterpakagelist as $masterpakage)
                                                <option value="{{$masterpakage->P_Id}}" {{$masterpakage->P_Id == $companiespakages->PName ? 'selected' : '' }}>{{$masterpakage->PName}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('pakagename'))
                                            <span class="text-danger">{{ $errors->first('pakagename') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Start Date</label>
                                            <time datetime="1914-12-20 08:30:45">
                                                <input type="date" name="startdate" value="{{{ \Carbon\Carbon::parse($companiespakages->startDate)->format('Y-m-d') }}}" class="form-control" id="startdate" placeholder="Start Date" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">End Date</label>
                                            <input type="date" name="enddate" value="{{{ \Carbon\Carbon::parse($companiespakages->endDate)->format('Y-m-d') }}}" class="form-control" id="enddate" placeholder="End Date" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="defaultSelect" class="form-label">AutoRew New</label>
                                            <select id="autorewnew" name="autorewnew" class="form-select">
                                                <option>Select</option>
                                                <option value="1" @if($companiespakages->autoRenew === '1') selected @endif>Yes</option>
                                                <option value="0" @if($companiespakages->autoRenew === '0') selected @endif>No</option>
                                            </select>
                                            @if ($errors->has('autorewnew'))
                                            <span class="text-danger">{{ $errors->first('autorewnew') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="defaultSelect" class="form-label">Status</label>
                                            <select id="status" name="status" class="form-select">
                                                <option>Select</option>
                                                <option value="1" @if($companiespakages->status === '1') selected @endif>Active</option>
                                                <option value="0" @if($companiespakages->status === '0') selected @endif>Deactive</option>
                                            </select>
                                            @if ($errors->has('status'))
                                            <span class="text-danger">{{ $errors->first('status') }}</span>
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
