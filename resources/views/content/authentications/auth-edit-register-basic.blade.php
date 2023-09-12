@extends('layouts/layoutMaster')

@section('title', 'Wizard Icons - Forms')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/form-wizard-icons.js')}}"></script>
@endsection

@section('content')

<!-- Default -->
<div class="container">
    <div class="row">
        <!-- Vertical Icons Wizard -->
        <div class="col-12 mb-4 ">
            <div class="bs-stepper vertical wizard-vertical-icons-example mt-2">
                <div class="bs-stepper-header">
                    <div class="step" data-target="#companies-basic-details-vertical">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">
                                <i class="ti ti-file-description"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Companies Basic Details</span>
                                <span class="bs-stepper-subtitle">Companies Basic Details</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#companies-info-vertical">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Companies Info</span>
                                <span class="bs-stepper-subtitle">Add Companies info</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    {{-- <div class="step" data-target="#companies-Job-Preferences-vertical">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Companies Job Preferences</span>
                                <span class="bs-stepper-subtitle">Add Job Preferences info</span>
                            </span>
                        </button>
                    </div> --}}
                    {{-- <div class="line"></div>
                    <div class="step" data-target="#social-links-vertical">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle"><i class="ti ti-brand-instagram"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Social Links</span>
                                <span class="bs-stepper-subtitle">Add social links</span>
                            </span>
                        </button>
                    </div> --}}
                </div>
                <div class="bs-stepper-content">
                    <form action="" method="post">
                        @csrf
                        <!-- companies-basic Details -->
                        <div id="companies-basic-details-vertical" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Companies Basic Details</h6>
                                <small>Enter Your Companies Basic Details.</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="companyname">Companies</label>
                                    <input type="text" id="companyname" name="companyname" class="form-control" placeholder="Enter Companies" />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="email1">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email" />
                                </div>
                                <div class="col-sm-6 form-password-toggle">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                        <span class="input-group-text cursor-pointer" id="password"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-password-toggle">
                                    <label class="form-label" for="confirm-password61">Confirm Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="confirm-password7" />
                                        <span class="input-group-text cursor-pointer" id="confirm-password7"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-label-secondary btn-prev" disabled> <i class="ti ti-arrow-left me-sm-1"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    {{-- <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></button> --}}
                                    <a href="#companies-info-vertical" class="btn btn-primary btn-next"><span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- companies Info -->
                        <div id="companies-info-vertical" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Companies Info</h6>
                                <small>Enter Your Companies Info.</small>
                            </div>
                            <div class="row g-3">
                                {{-- <div class="col-sm-6">
                                    <label class="form-label" for="companiesName">Companies Name</label>
                                    <input type="text" id="companiesname" name="companiesname" class="form-control" placeholder="Companies Name" />
                                </div> --}}
                                <div class="col-sm-6">
                                    <label class="form-label" for="website">Website</label>
                                    <input type="text" id="website" name="website" class="form-control" placeholder=" Enter Website" />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Companies Phone No" />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="mobile">Mobile</label>
                                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder=" Companies Mobile No" />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="contactname">Contact Name</label>
                                    <input type="text" id="contactname" name="contactname" class="form-control" placeholder="Companies Contact Name" />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="address">Address</label>
                                    <input type="text" id="address" name="address" class="form-control" placeholder=" Companies Address" />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="city">City</label>
                                    <input type="text" id="city" name="city" class="form-control" placeholder="Companies City" />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="state">State</label>
                                    <input type="text" id="state" name="state" class="form-control" placeholder=" Companies State" />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="country">Country</label>
                                    <select class="select2" id="country" name="country">
                                        <option label=" "></option>
                                        <option>India</option>
                                        <option>America</option>
                                        <option>Nepal</option>
                                        <option>Dubai</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="gstin">GSTIN</label>
                                    <input type="text" id="gstin" name="gstin" class="form-control" placeholder=" Companies GSTIN" />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="pan">PAN</label>
                                    <input type="text" id="pan" name="pan" class="form-control" placeholder=" Companies PAN" />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="identityproof">Identity Proof</label>
                                    <input type="file" id="identityproof" name="identityproof" class="form-control" placeholder=" Companies Identity Proof" />
                                </div>
                                {{-- <div class="col-sm-6">
                                    <label class="form-label" for="caffiliateCode">CAffiliate Code</label>
                                    <input type="text" id="caffiliateCode" name="caffiliateCode" class="form-control" placeholder="Companies CAffiliate Code" />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="fromcaff">From CAff</label>
                                    <input type="text" id="fromcaff" name="fromcaff" class="form-control" placeholder=" Companies From CAff" />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="fromeaff">From EAff</label>
                                    <input type="text" id="fromeaff" name="fromeaff" class="form-control" placeholder="Companies From EAff" />
                                </div> --}}
                                <div class="col-12 d-flex justify-content-between">
                                    {{-- <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button> --}}
                                    <a href="#companies-basic-details-vertical" class="btn btn-label-secondary btn-prev"><span class="align-middle d-sm-inline-block d-none me-sm-1">Previous</span> <i class="ti ti-arrow-left me-sm-1"></i></a>
                                    {{-- <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></button> --}}
                                    {{-- <a href="#social-links-vertical" class="btn btn-primary btn-next"><span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></a> --}}
                                    <button type="submit" value="submit" class="btn btn-success">Submit</button>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /Vertical Icons Wizard -->
    </div>
</div>


@endsection
