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
                            <h5 class="card-header">Companies pakages <a href="{{route('company-pakage.create')}}" class="btn btn-success btn-sm float-end">Create</a></h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Company Name</th>
                                            <th>pakage Name</th>
                                            <th>start date</th>
                                            <th>end date</th>
                                            <th>autorewnew</th>
                                            <th>status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse ($companiepakageList as $companypakage)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$companypakage->companies->CompanyName}}</td>
                                            <td>{{$companypakage->MasterPakage->PName}}</td>
                                            <td>{{$companypakage->startDate}}</td>
                                            <td>{{$companypakage->endDate}}</td>
                                            <td>
                                                @if($companypakage->autoRenew == 0)
                                                <span class="badge bg-label-danger me-1">No</span>
                                                @elseif($companypakage->autoRenew == 1)
                                                <span class="badge bg-label-success me-1">Yes</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($companypakage->status == 0)
                                                <span class="badge bg-label-danger me-1">Deactive</span>
                                                @elseif($companypakage->status == 1)
                                                <span class="badge bg-label-success me-1">Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('company-pakage.edit',$companypakage->CP_Id)}}"><i class="ti ti-pencil me-1"></i> Edit</a>
                                                        <a class="dropdown-item" href="{{route('company-pakage.delete',$companypakage->CP_Id)}}"><i class="ti ti-trash me-1"></i> Delete</a>
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
