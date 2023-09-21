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
<script src="{{asset('assets/js/custom/empcustom.js')}}"></script>
@endsection

@include('layouts/sections/header/header')

<script>
    var BASE_URL = "{{URL::to('/')}}";
</script>

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


<!-- Default -->
<div class="container mt-5">
    <div class="row">
        <!-- Vertical Icons Wizard -->
        <div class="col-12 mb-4 ">
            <div class="bs-stepper vertical wizard-vertical-icons-example mt-2">
                <div class="bs-stepper-header">
                    <div class="step" data-target="#step1">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">
                                <i class="ti ti-file-description"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Employee Basic Details</span>
                                <span class="bs-stepper-subtitle">Employee Basic Details</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#step2">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Professional Details</span>
                                <span class="bs-stepper-subtitle">Add Professional Details</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#step3">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">
                            <i class="ti ti-files"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Employment Details</span>
                                <span class="bs-stepper-subtitle">Add Employment Details</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#step4">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">
                            <i class="ti ti-id-badge"></i> 
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title"> Job Preferences </span>
                                <span class="bs-stepper-subtitle">Add Job Preferences </span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#step5"> 
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">
                            <i class="fa-solid fa-graduation-cap"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title"> Education  </span>
                                <span class="bs-stepper-subtitle">Add Education  </span>
                            </span>
                        </button>
                    </div>

                    <div class="line"></div>
                </div>
                <div class="bs-stepper-content">
                    <form action="{{route('auth-eregister-store')}}" method="POST" name="RegistrationForm" id="RegistrationForm" enctype="multipart/form-data">
                        @csrf
                        <!-- Company-basic Details -->
                        <div id="step1" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Employee Basic Details</h6>
                                <small>Enter Your Employee Basic Details.</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="employeename">Employee Full Name<span class="text-danger">*</span></label>
                                    <input type="text" id="employeename" name="employeename" class="form-control" placeholder="Enter Full Name" value="{{old('employeeName')}}"/>
                                    <span class="error" id="employeenameError"></span>
                                    <!-- @error('EmployeeName')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="Email">Employee Email Address<span class="text-danger">*</span></label>
                                    <input type="Email" id="Email" name="Email" class="form-control" placeholder="Enter Email Address" value="{{old('Email')}}"/>
                                    <span class="error" id="emailError"></span>
                                    <!-- @error('Email')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6 form-password-toggle">
                                    <label class="form-label" for="password">Password<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                        <span class="input-group-text cursor-pointer" id="password"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                    <span class="error" id="passwordError"></span>
                                    <!-- @error('password')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6 form-password-toggle">
                                    <label class="form-label" for="confirm-password">Confirm Password<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="confirm-password" name="password_confirmation" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="confirm-password7" />
                                        <span class="input-group-text cursor-pointer" id="confirm-password7"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                    <span class="error" id="confirmpasswordError"></span>
                                    <!-- @error('password_confirmation')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6">
                                <label class="form-label" for="mobile">Employee Mobile Number<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <input type="tel" id="mobile" name="mobile" class="form-control" placeholder="Enter Mobile Number " value="{{old('mobile')}}" />
                                    </div>
                                    <span class="error" id="mobileError"></span>
                                    <!-- @error('mobile')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Gender
                                        <!-- <span class="text-danger">*</span> -->
                                    </label>
                                    <div class="col mt-2">
                                        <div class="form-check form-check-inline">
                                            <input name="Gender" class="form-check-input gender" type="radio" id="gender_male" value="Male" {{(old('Gender') == 'Male') ? 'checked' : ''}}  checked>
                                            <label class="form-check-label" for="gender_male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="Gender" class="form-check-input gender" type="radio" id="gender_female" value="Female" {{(old('Gender') == 'Female') ? 'checked' : ''}}>
                                            <label class="form-check-label" for="gender_female"> Female </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="Gender" class="form-check-input gender" type="radio" id="gender_other" value="Other" {{(old('Gender') == 'Other') ? 'checked' : ''}}>
                                            <label class="form-check-label" for="gender_other"> Other </label>
                                        </div>
                                        <br>
                                        <!-- @error('Gender')
                                        <font color="red">{{ $message }}</font>
                                        @enderror -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="resume">Resume
                                        <!-- <span class="text-danger">*</span> -->
                                    </label>
                                    <input type="file" id="resume" name="Resume" class="form-control" accept=".doc,.docx,.pdf" value="{{old('Resume')}}" />
                                    <!-- @error('Resume')                       
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-label-secondary btn-prev" disabled> <i class="ti ti-arrow-left me-sm-1"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                   <button type="button"class="btn btn-primary btn-next-page"> <a href="#step2" style="color:white;"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span></a> <i class="ti ti-arrow-right"></i></button> 
                                </div>
                            </div>
                        </div>
                        <!-- professional details Info -->
                        <div id="step2" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Professional Details </h6>
                                <small>Enter Your Professional Details.</small>
                            </div>
                            <div class="col-12">
                                <div class="row gy-3 mt-0">
                                    <div class="col-xl-4 col-md-5 col-sm-6 col-12">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="experienced">
                                                <span class="custom-option-body">
                                                    <i class="fa-solid fa-face-smile"></i>
                                                    <span class="custom-option-title"> I am Experienced</span>
                                                    <small> Experienced </small>
                                                </span>
                                                <input name="type" class="form-check-input experienceDetail" type="radio" value="experience" id="experienced" checked/>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-5 col-sm-6 col-12">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="fresher">
                                                <span class="custom-option-body">
                                                    <i class="fa fa-user"></i>
                                                    <span class="custom-option-title"> I am a Fresher </span>
                                                    <small> Fresher </small>
                                                </span>
                                                <input name="type" class="form-check-input experienceDetail" type="radio" value="fresher" id="fresher" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-5 col-sm-6 col-12">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="student">
                                                <span class="custom-option-body">
                                                    <i class="fa fa-graduation-cap"></i> 
                                                    <span class="custom-option-title"> I am a Student </span>
                                                    <small> Student </small>
                                                </span>
                                                <input name="type" class="form-check-input experienceDetail" type="radio" value="student" id="student" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row g-3">
                                    <div class="col-sm-6 radioBtnChoose mb-4 expYearDiv">
                                        <label class="form-label" for="expYear">Year<span class="text-danger">*</span></label>
                                        <select class="select2" id="expYear" name="expYear">
                                            <option label=" "></option>
                                            @for($i=1;$i<=30;$i++)
                                            <option label="{{$i}}" value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <span class="error" id="YearError"></span>
                                        <!-- @error('expYear')
                                            <font color="red">{{ $message }}</font>
                                        @enderror -->
                                    </div>
                                    <div class="col-sm-6 radioBtnChoose mb-4 expYearDiv">
                                        <label class="form-label" for="expmonth">Month<span class="text-danger">*</span></label>
                                        <select class="select2" id="expmonth" name="expmonth">
                                            <option label=" "></option>
                                            @for($i=1;$i<=11;$i++)
                                            <option label="{{$i}}" value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <span class="error" id="MonthError"></span>
                                        <!-- @error('expmonth')
                                            <font color="red">{{ $message }}</font>
                                        @enderror -->
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-sm-6 radioBtnChoose mb-4">
                                        <label class="form-label" for="location">Current Location<span class="text-danger">*</span></label>
                                            <select class="select2" id="location" name="location">
                                                <option label=" "></option>
                                                <option>India</option>
                                                <option>America</option>
                                                <option>Nepal</option>
                                                <option>Dubai</option>
                                            </select>
                                            <span class="error" id="LocationError"></span>
                                            <!-- @error('location')
                                                <font color="red">{{ $message }}</font>
                                            @enderror -->
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="#step1" class="btn btn-primary btn-prev"><span class="align-middle d-sm-inline-block d-none me-sm-1">Previous</span> <i class="ti ti-arrow-left me-sm-1"></i></a>
                                    <a href="#step3" class="btn btn-primary btn-next-page" ><span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right "></i></a> 
                                </div>   
                            </div>
                        </div>
                        <!-- Employment details -->
                        <div id="step3" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Employment Details</h6>
                                <small>Enter Your Employment Details.</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="Designation">Current Designation<span class="text-danger">*</span></label>
                                    <input type="text" id="Designation" name="Designation" class="form-control" placeholder="Enter Designation" value="{{old('Designation')}}"/>
                                    <span class="error" id="DesignationError"></span>
                                    <!-- @error('Designation')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="Company">Company Name<span class="text-danger">*</span></label>
                                    <input type="text" id="Company" name="Company" class="form-control" placeholder="Enter Company Name" value="{{old('Company')}}"/>
                                    <span class="error" id="CompanyError"></span>
                                    <!-- @error('Company')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6 ">
                                    <label class="form-label" for="start_year">Select Start Year<span class="text-danger">*</span> </label>
                                    <select class="select2" id="start_year" name="start_year">
                                    <option value="">Select Year</option>
                                    <?php
                                        $already_selected_value = "select year";
                                        $earliest_year = 1950;
                                        foreach (range(date('Y'), $earliest_year) as $x) {
                                            print '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
                                        }
                                    ?>
                                    </select>
                                    <span class="error" id="StartYearError"></span>
                                    <!-- @error('start_year')
                                        <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6 ">
                                <label class="form-label" for="start_month">Select Start Month<span class="text-danger">*</span> </label>
                                    <select class="select2" id="start_month" name="start_month">
                                        <option value="">Select Month</option>
                                        <?php
                                            for ($i = 1; $i <= 12; ++$i) {
                                            echo '<option value="'. $i.'">'. date('F', mktime(0,0,0,$i)).'</option>'."\n";
                                            }
                                        ?>
                                    </select>
                                    <span class="error" id="StartMonthError"></span>
                                    <!-- @error('start_month')
                                        <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6 ">
                                    <label class="form-label" for="end_year">Select End Year<span class="text-danger">*</span> </label>
                                    <select class="select2" id="end_year" name="end_year">
                                    <option value="">Select Year</option>
                                    <?php
                                        $already_selected_value = "select year";
                                        $earliest_year = 1950;
                                        foreach (range(date('Y'), $earliest_year) as $x) {
                                            print '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
                                        }
                                    ?>
                                    </select>
                                    <span class="error" id="EndYearError"></span>
                                    <!-- @error('end_year')
                                        <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6 ">
                                <label class="form-label" for="end_month">Select End Month<span class="text-danger">*</span> </label>
                                    <select class="select2" id="end_month" name="end_month">
                                        <option value="">Select Month</option>
                                        <?php
                                            for ($i = 1; $i <= 12; ++$i) {
                                            echo '<option value="'. $i.'">'. date('F', mktime(0,0,0,$i)).'</option>'."\n";
                                            }
                                        ?>
                                    </select>
                                    <span class="error" id="EndMonthError"></span>
                                    <!-- @error('end_month')
                                        <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="YearlySal">Current Salary (Annual)<span class="text-danger">*</span></label>
                                    <input type="text" id="YearlySal" name="YearlySal" class="form-control" placeholder="Enter Current Salary" value="{{old('YearlySal')}}"/>
                                    <span class="error" id="CurrentSalaryError"></span>
                                    <!-- @error('YearlySal')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="NoticePeriod"> Notice Period<span class="text-danger">*</span></label>
                                    <select class="select2" id="NoticePeriod" name="NoticePeriod">
                                        <option value="">Select duration</option>
                                        <option value="Immediately">Immediately</option>
                                        <option value="5 Days">5 Days</option>
                                        <option value="15 Days">15 Days</option>
                                        <option value="30 Days">30 Days</option>
                                        <option value="45 Days">45 Days</option>
                                        <option value="60 Days">60 Days</option>
                                        <option value="90 Days">90 Days</option>
                                    </select>
                                    <span class="error" id="NoticePeriodError"></span>
                                    <!-- <input type="text" id="NoticePeriod" name="NoticePeriod" class="form-control" placeholder="Enter Notice Period" value="{{old('NoticePeriod')}}"/> -->
                                    <!-- @error('NoticePeriod')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="#Employee-basic-details" class="btn btn-primary btn-prev"><span class="align-middle d-sm-inline-block d-none me-sm-1">Previous</span> <i class="ti ti-arrow-left me-sm-1"></i></a>
                                   <button type="button"class="btn btn-primary btn-next-page"> <a href="#step4" style="color:white;"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span></a> <i class="ti ti-arrow-right"></i></button> 
                                </div>
                            </div>
                        </div>
                        <!-- Employment job-preferences details -->
                        <div id="step4" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Job Preferences Details</h6>
                                <small>Enter Your Job Preferences Details.</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="Skills">Skills<span class="text-danger">*</span></label>
                                    <input type="text" id="Skills" name="Skills" class="form-control" placeholder="Enter Skills" value="{{old('skills')}}" multiple/>
                                    <span class="error" id="SkillError"></span>
                                    <!-- @error('skills')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6 ">
                                    <label class="form-label" for="Preferedlocation">Prefered Location<span class="text-danger">*</span> </label>
                                    <select class="select2" id="Preferedlocation" name="Preferedlocation">
                                        <option value="">Select city</option>
                                        <option value="Ahmedabad">Ahmedabad</option>   
                                        <option value="Mehsana">Mehsana</option> 
                                    </select>
                                    <span class="error" id="PreferedLocationError"></span>
                                    <!-- @error('Preferedlocation')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="role">Prefered Role<span class="text-danger">*</span></label>
                                    <input type="text" id="role" name="role" class="form-control" placeholder="Enter Prefered Role" value="{{old('role')}}"/>
                                    <span class="error" id="RoleError"></span>
                                    <!-- @error('role')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6 ">
                                    <label class="form-label" for="locationP">Prefered Location<span class="text-danger">*</span> </label>
                                    <select class="select2" id="locationP" name="locationP">
                                        <option value="">Select Prefered Location</option>
                                        <option value="Ahmedabad">Ahmedabad</option>
                                        <option value="Rajkot">Rajkot</option>
                                    </select>
                                    <span class="error" id="LocationPError"></span>
                                    <!-- @error('locationP')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="#Employee-basic-details" class="btn btn-primary btn-prev"><span class="align-middle d-sm-inline-block d-none me-sm-1">Previous</span> <i class="ti ti-arrow-left me-sm-1"></i></a>
                                    <button type="button"class="btn btn-primary btn-next-page"> <a href="#step5" style="color:white;"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span></a> <i class="ti ti-arrow-right"></i></button> 
                                </div>
                            </div>
                        </div>
                        <!-- Employment Education details -->
                        <div id="step5" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Education Details</h6>
                                <small>Enter Your Education Details.</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="Highesteducation">Highest Education<span class="text-danger">*</span></label>
                                    <input type="text" id="Highesteducation" name="Highesteducation" class="form-control" placeholder="Enter Highest Education" value="{{old('Highesteducation')}}" multiple/>
                                    <span class="error" id="HighestEducationError"></span>
                                    <!-- @error('Highesteducation')
                                    <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="University">University (Optional)</label>
                                    <input type="text" id="University" name="University" class="form-control" placeholder="Enter University" value="{{old('University')}}" multiple/>
                                </div>  
                                <div class="col-sm-6 ">
                                    <label class="form-label" for="yGraduation">Years Of Graduation<span class="text-danger">*</span> </label>
                                    <select class="select2" id="yGraduation" name="yGraduation">
                                    <option label=" ">Select Year</option>
                                    <?php
                                        $already_selected_value = "select year";
                                        $earliest_year = 1950;
                                        foreach (range(date('Y'), $earliest_year) as $x) {
                                            print '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
                                        }
                                    ?>
                                    </select>
                                    <span class="error" id="YearGraduationError"></span>
                                    <!-- @error('yGraduation')
                                        <font color="red">{{ $message }}</font>
                                    @enderror -->
                                </div>
                                <div class="col-sm-6 ">
                                    <label class="form-label" for="eType">Education Type (Optional) </label>
                                    <select class="select2" id="eType" name="eType">
                                        <option label=" ">Select Education Type</option>
                                        <option value="Part-time">Part-time</option>
                                        <option value="Full-time">Full-time</option>
                                        <option value="Correspondence">Correspondence</option>
                                    </select>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="#Employee-basic-details" class="btn btn-primary btn-prev"><span class="align-middle d-sm-inline-block d-none me-sm-1">Previous</span> <i class="ti ti-arrow-left me-sm-1"></i></a>
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
@include('layouts/sections/footer/footer-auth')
<script>
    $(document).ready(function () {
        $(document).on("click",".experienceDetail",function(){
            if($(this).val()== "experience"){
                $(".expYearDiv").show();
            }else{
                $(".expYearDiv").hide();
            }
            
        });
    });
</script>
@endsection

