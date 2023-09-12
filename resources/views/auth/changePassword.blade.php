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
                        <!-- changePassword -->
                        <div class="row">
                            <div class="col-xl">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Change Password</h5>
                                    </div>
                                    <div class="card-body">
                                        @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                        @endif
                                        @if (session('error'))
                                        <div class="alert alert-warning">
                                            {{ session('error') }}
                                        </div>
                                        @endif
                                        <form action="{{route('updateChangePassword')}}" method="POST">
                                            @csrf
                                            <div class="mb-3 form-password-toggle">
                                                <label class="form-label" for="currentpassword">Current Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="currentpassword" name="currentpassword" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="currentpassword" />
                                                    <span class="input-group-text cursor-pointer" id="currentpassword"><i class="ti ti-eye-off"></i></span>
                                                </div>
                                            </div>
                                            <div class="mb-3 form-password-toggle">
                                                <label class="form-label" for="newpassword">New Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="newpassword" />
                                                    <span class="input-group-text cursor-pointer" id="newpassword"><i class="ti ti-eye-off"></i></span>
                                                </div>
                                            </div>
                                            <div class="mb-3 form-password-toggle">
                                                <label class="form-label" for="conformpassword">Conform Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="conformpassword" name="conformpassword" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="conformpassword" />
                                                    <span class="input-group-text cursor-pointer" id="conformpassword"><i class="ti ti-eye-off"></i></span>
                                                </div>
                                            </div>

                                            <button type="submit" value="submit" class="btn btn-primary">Change Password</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- / changePassword -->
                    </div>


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
