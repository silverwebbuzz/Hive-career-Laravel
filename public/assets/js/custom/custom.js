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
            ValidateRegiterCompany();
            
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

// const companyNameInput = document.getElementById("companyname");
//     companyNameInput.addEventListener("input", function () {
//     this.value = this.value.replace(/\s/g, ""); // Remove any spaces
// });

function ValidateRegiterCompany() {
    let isValid = true;
    currentStep = 1;
    if (currentStep === 1) {

        const companyNameInput = document.getElementById("companyname");
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById("confirmpassword");
        const emailInput = document.getElementById("email");
        
        const companyName = companyNameInput.value.trim();;
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        const email = emailInput.value.trim(); // Trim the input
        
        const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
        const companyformat = /^[a-zA-Z\s]+$/;
        // Clear previous error messages
        document.getElementById("companynameError").textContent = "";
        document.getElementById("emailError").textContent = "";
        document.getElementById("passwordError").textContent = "";
        document.getElementById("confirmpasswordError").textContent = "";
       
        if (companyName === "") {
            companynameError.textContent = "Company Name is required.";
            isValid = false;
          } else if (!companyName.match(companyformat)) {
            companynameError.textContent = "Company Name should contain only alphabetic characters and spaces.";
            isValid = false;
          } else {
            companynameError.textContent = "";
          }

          if (email === "") {
            emailError.textContent = "email address is required.";
            isValid = false;
          } else if (!email.match(mailformat)) {
            emailError.textContent = "Invalid email address.";
            isValid = false;
          } else {
            emailError.textContent = "";
          }

        if (password === "") {
            passwordError.textContent = "Password is required.";
            isValid = false;
          } else if (password.length < 6) {
            passwordError.textContent = "Password should be at most 6 characters long.";
            isValid = false;
          } else {
            passwordError.textContent = "";
          }


        // Check if the confirm password is required and matches the password
        if (confirmPassword === "") {
            confirmpasswordError.textContent = "Confirm Password is required.";
            isValid = false;
        } else if (confirmPassword !== password) {
            confirmpasswordError.textContent = "Passwords do not match.";
            isValid = false;
        } else {
            confirmpasswordError.textContent = "";
        }

        if (isValid) {
            currentStep++;
            $("#step1").removeClass('active');
            $("#step2").addClass('active');
            $.ajax({
                url: BASE_URL + "/company/register/basic-info",
                method: "POST",
                dataType: 'json',
                data:{
                    'companyName': document.getElementById("companyname").value,
                    'email': document.getElementById("email").value,
                    'password' : document.getElementById("password").value,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var caffiliateCode = response.data.CAffiliateCode;
                    $("#referralcode").val(caffiliateCode);
                },
                error: function (xhr, status, error) {
                  $("#result").html("Error: " + error);
                }
              });
            $('[data-target="#step1"]').removeClass("active");
            $('[data-target="#step2"]').addClass("active");
        }
    } 
    // else if (currentStep === 2) {
    //     // Validate Step 2 fields, if any, and proceed to the next step if valid
    //     // You can add similar validation logic for Step 2 fields
    //     // If there are no Step 2 fields, you can simply increment currentStep
    //     currentStep++;
    //     document.getElementById("step2").style.display = "none";
    //     // Proceed to the next step or finish the form as needed
    // }
  
}