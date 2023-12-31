@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Two Steps Verifications Cover - Pages')

@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/pages-auth.js')}}"></script>
<script src="{{asset('assets/js/pages-auth-two-steps.js')}}"></script>
@endsection

@section('content')
<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">

        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/img/illustrations/auth-two-step-illustration-'.$configData['style'].'.png') }}" alt="auth-two-steps-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-two-step-illustration-light.png" data-app-dark-img="illustrations/auth-two-step-illustration-dark.png">

                <img src="{{ asset('assets/img/illustrations/bg-shape-image-'.$configData['style'].'.png') }}" alt="auth-two-steps-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png">
            </div>
        </div>
        <!-- /Left Text -->

        <!-- Email Verification -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-4 p-sm-5">
            <div class="w-px-400 mx-auto">
                <!-- Logo -->
                <div class="app-brand mb-4">
                    <a href="{{url('/')}}" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">@include('_partials.macros',['height'=>20,'withbg' => "fill: #fff;"])</span>
                    </a>
                </div>
                <!-- /Logo -->

                <h3 class="mb-1">Email Verification 💬</h3>

                <p class="mb-0 fw-medium">Type your 4 digit security code</p>
                <form id="twoStepsForm" action="{{route('emailVerifyLogin')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper">
                            <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" autofocus>
                            <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1">
                            <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1">
                            <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1">
                        </div>
                        <!-- Create a hidden field which is combined by 3 fields above -->
                        <input type="hidden" name="otp" />
                        <input type="hidden" name="Com_Id" value="{{ $Com_Id }}">
                    </div>
                    <button class=" btn btn-primary d-grid w-100 mb-3" type="submit" value="submit">
                        Verify my account
                    </button>
                    <div class="text-center">Didn't get the code?
                        <a href="{{route('resendOtp',['Com_id' =>$Com_Id])}}">
                            Resend
                        </a>
                        {{-- <a href="">
                            Resend
                        </a> --}}
                    </div>
                </form>
                @if (session('error'))
                <p class="text-danger text-center mt-3"><strong>{{ session('error') }}</strong></p>
                @endif
            </div>
        </div>
        <!-- /Email Verification -->
    </div>
</div>
@endsection
