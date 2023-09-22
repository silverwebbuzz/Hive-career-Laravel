let currentStep = 1;

$(function () {
    OnClickEvent.init();
    Validation.init();
    OnChangeEvent.init();
    OnPageLoadEvent.init();
});

OnPageLoadEvent = {
    init:function(){

    },
}

OnChangeEvent = {
    init:function(){

    },
}

OnClickEvent = {
    init:function(){
        $(document).on('click','.btn-next-page','.step',function(){
            alert(currentStep+1);
            ValidateRegiterEmployee();
        });
    },
}

Validation = {
    init:function(){
        Validation.validforms();
    },
    validforms:function(){
        
    }
}



const mailformat = {
    mailformat: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
  
    valid: function (email) {
      return this.mailformat.test(email);
    },
  };

function employeeDetailStore(){
  $.ajax({
    url: BASE_URL + "/employee/basic",
    method: "POST",
    dataType: 'json',
    data:{
      formdata : $('#RegistrationForm').serialize(),
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {
        if(currentStep==2){
          $('[data-target="#step1"]').removeClass("active");
          $('[data-target="#step2"]').addClass("active");
        }else{
          $('[data-target="#step2"]').removeClass("active");
          $('[data-target="#step3"]').addClass("active");
        }
       

    },
    error: function (xhr, status, error) {
      $("#result").html("Error: " + error);
    }
  });
}

function employeeExperience(){
  $.ajax({
    url: BASE_URL + "/employee/experience",
    method: "POST",
    dataType: 'json',
    data:{
      formdata : $('#RegistrationForm').serialize(),
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {
      $('[data-target="#step3"]').removeClass("active");
      $('[data-target="#step4"]').addClass("active");
    },
    error: function (xhr, status, error) {
      $("#result").html("Error: " + error);
    }
  });
}
function AlphabeticValue(){
  return /^[a-zA-Z\s]+$/;
}
function NumberFormat(){
    return /^[0-9]+$/;
}

function ValidateRegiterEmployee(){
    let isValid = true;
    if (currentStep === 1) {
        const employeeNameInput = document.getElementById("employeename").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm-password").value;
        const emailInput = document.getElementById("Email").value;
        const MobileInput = document.getElementById("mobile").value;
        const employeeName = employeeNameInput.trim();
        const email = emailInput.trim(); // Trim the input
        const mobile = MobileInput.trim();
        const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
        const mobileformat = /^[0-9]+$/;

        // Clear previous error messages
        document.getElementById("employeenameError").textContent = "";
        document.getElementById("emailError").textContent = "";
        document.getElementById("passwordError").textContent = "";
        document.getElementById("confirmpasswordError").textContent = "";
        document.getElementById("mobileError").textContent = "";
       
        //employeename validation
        if (employeeName === "") {
          employeenameError.textContent = "Employee Name is required.";
          isValid = false;
        } else if (!employeeName.match(AlphabeticValue())) {
          employeenameError.textContent = "Employee Name should contain only alphabetic characters and spaces.";
          isValid = false;
        } else {
          employeenameError.textContent = "";
        }

          //email validation
          if (email === "") {
            emailError.textContent = "email address is required.";
            isValid = false;
          } else if (!email.match(mailformat)) {
            emailError.textContent = "Invalid email address.";
            isValid = false;
          } else {
            emailError.textContent = "";
          }

          //password is required
          if (password === "") {
            passwordError.textContent = "Password is required.";
            isValid = false;
          }else if (password.length < 6) {
            passwordError.textContent = "Password should be at most 6 characters long.";
            isValid = false;
          } else {
            passwordError.textContent = "";
          }


        //Check if the confirm password is required and matches the password
        if (confirmPassword === "") {
            confirmpasswordError.textContent = "Confirm Password is required.";
            isValid = false;
        } else if (confirmPassword !== password) {
            confirmpasswordError.textContent = "Passwords do not match.";
            isValid = false;
        } else {
            confirmpasswordError.textContent = "";
        }

        //mobile validation
        if (mobile === "") {
          mobileError.textContent = "Mobile number is required.";
          isValid = false;
        } else if (mobile.length != 10) {
          mobileError.textContent = "Invalid mobile number";
          isValid = false;
        }else if (!mobile.match(mobileformat)) {
          mobileError.textContent = "Mobile number should contain only numerical.";
          isValid = false;
        } else {
          mobileError.textContent = "";
        }

        if (isValid) {
          currentStep++;
          employeeDetailStore();
          $("#step1").removeClass('active');
          $("#step2").addClass('active');
          $('[data-target="#step1"]').removeClass("active");
          $('[data-target="#step2"]').addClass("active");
          $("#step1").removeClass('active dstepper-block');
          $("#step2").addClass('active dstepper-block');
        }
    } 
    else if (currentStep === 2) {
      const ExpYear = document.getElementById("expYear").value;
      const ExpMonth = document.getElementById("expmonth").value;
      const Location = document.getElementById("location").value;

      // Clear previous error messages
      document.getElementById("YearError").textContent = "";
      document.getElementById("MonthError").textContent = "";
      document.getElementById("LocationError").textContent = "";

      if($('#experienced').is(':checked')){
        //exp years validaion
        if (ExpYear === "") {
          YearError.textContent = "Select experiance Year";
          isValid = false;
        }

        //exp month validation
        if (ExpMonth === "") {
          MonthError.textContent = "select experiance Month";
          isValid = false;
        }

        //location validation
        if (Location === "") {
          LocationError.textContent = "select location";
          isValid = false;
        }
      }else{
        if (Location === "") {
          LocationError.textContent = "select location";
          isValid = false;
        }
      }
      
      
      if (isValid) {
        currentStep++;
        employeeDetailStore();
        $('[data-target="#step2"]').removeClass("active");
        $('[data-target="#step3"]').addClass("active");
        $("#step2").removeClass('active dstepper-block');
        $("#step3").addClass('active dstepper-block');
      }
    }
    else if (currentStep === 3) {
        const DesignationInput = document.getElementById("Designation").value;
        const Company = document.getElementById("Company").value;
        const StartYear = document.getElementById("start_year").value;
        const StartMonth = document.getElementById("start_month").value;
        const EndYear = document.getElementById("end_year").value;
        const EndMonth = document.getElementById("end_month").value;
        const CurrentSalary = document.getElementById("YearlySal").value;
        const NoticePeriod = document.getElementById("NoticePeriod").value;

        // Clear previous error messages
        document.getElementById("DesignationError").textContent = "";
        document.getElementById("CompanyError").textContent = "";
        document.getElementById("StartYearError").textContent = "";
        document.getElementById("StartMonthError").textContent = "";
        document.getElementById("EndYearError").textContent = "";
        document.getElementById("EndMonthError").textContent = "";
        document.getElementById("CurrentSalaryError").textContent = "";
        document.getElementById("NoticePeriodError").textContent = "";

        // Designation Name
        if (DesignationInput === "") {
          DesignationError.textContent = "Designation is required";
          isValid = false;
        } else if (!DesignationInput.match(AlphabeticValue())) {
          DesignationError.textContent = "Designation should contain only alphabetic characters and spaces.";
          isValid = false;
        } else {
          DesignationError.textContent = "";
        }

        // Company Name
        if (Company === "") {
          CompanyError.textContent = "Company is required";
          isValid = false;
        } else if (!Company.match(AlphabeticValue())) {
          CompanyError.textContent = "Company should contain only alphabetic characters and spaces.";
          isValid = false;
        } else {
          CompanyError.textContent = "";
        }

        //start year validation
        if (StartYear === "") {
          StartYearError.textContent = "Select Start Year";
          isValid = false;
        }

        //start month validation
        if (StartMonth === "") {
          StartMonthError.textContent = "select Start Month";
          isValid = false;
        }

        //end year validation
        if (EndYear === "") {
          EndYearError.textContent = "select Start Month";
          isValid = false;
        }

        //end month validation
        if (EndMonth === "") {
          EndMonthError.textContent = "select Start Month";
          isValid = false;
        }

        //current salary validation
        if (CurrentSalary === "") {
          CurrentSalaryError.textContent = "Current Salary is Required";
          isValid = false;
        }else if(!CurrentSalary.match(NumberFormat())){
          CurrentSalaryError.textContent = "Current Salary is Required";
        }

        //notice period validation
        if (NoticePeriod === "") {
          NoticePeriodError.textContent = "Please Select Notice Period";
          isValid = false;
        }

      if (isValid) {
        currentStep++;
        employeeExperience();
        $("#step3").removeClass('active dstepper-block');
        $("#step4").addClass('active dstepper-block');
      }
      }else if (currentStep === 4) {
        const SkillsInput = document.getElementById("Skills").value;
        const PreferedLocation = document.getElementById("Preferedlocation").value;
        const Role = document.getElementById("role").value;
        const LocationP = document.getElementById("locationP").value;

        // Clear previous error messages
        document.getElementById("SkillError").textContent = "";
        document.getElementById("PreferedLocationError").textContent = "";
        document.getElementById("RoleError").textContent = "";
        document.getElementById("LocationPError").textContent = "";

        // Skills validation
        if (SkillsInput === "") {
          SkillError.textContent = "Skills is required";
          isValid = false;
        } else if (!SkillsInput.match(AlphabeticValue())) {
          SkillError.textContent = "Skills should contain only alphabetic characters and spaces.";
          isValid = false;
        } else {
          SkillError.textContent = "";
        }

        //Prefered Location(City) validation
        if (PreferedLocation === "") {
          PreferedLocationError.textContent = "select Prefered Location";
          isValid = false;
        }

        // Prefered Role validation
        if (Role === "") {
          RoleError.textContent = "Role is required";
          isValid = false;
        } else if (!Role.match(AlphabeticValue())) {
          RoleError.textContent = "Role should contain only alphabetic characters and spaces.";
          isValid = false;
        } else {
          RoleError.textContent = "";
        }

        //Prefered Location validation
        if (LocationP === "") {
          LocationPError.textContent = "select Prefered Location";
          isValid = false;
        }

       if (isValid) {
        currentStep++;
        $('[data-target="#step4"]').removeClass("active");
        $('[data-target="#step5"]').addClass("active");
        $("#step4").removeClass('active dstepper-block');
        $("#step5").addClass('active dstepper-block');
        }
    }else if (currentStep === 5) {

      const HighestEducation = document.getElementById("Highesteducation").value;
      const YearGraduation = document.getElementById("yGraduation").value;

      // Clear previous error messages
      document.getElementById("HighestEducationError").textContent = "";
      document.getElementById("YearGraduationError").textContent = "";

      // Highest Education Error Message
      if (HighestEducation === "") {
        HighestEducationError.textContent = "Higest Education is required";
        isValid = false;
      } else if (!HighestEducation.match(AlphabeticValue())) {
        HighestEducationError.textContent = "Higest Education should contain only alphabetic characters and spaces.";
        isValid = false;
      } else {
        HighestEducationError.textContent = "";
      }

      if (YearGraduation === "") {
        YearGraduationError.textContent = "select Graduation Year";
        isValid = false;
      }
      if (isValid) {
      }
    }
}