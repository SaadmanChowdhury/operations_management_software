function login_error_toaster(error){


    var err_message="";
    switch(error){

        case 1:
            err_message="ID and password are required!";
        break;
             
        case 2:
            err_message="ID is required!";
             
        break;
        case 3:
            err_message="Password is required!";
        break;
        case 4:
            err_message="Password is required!";
        break;

        case 5:
            err_message="Valid email is required!";
        break;
        
    }

    makeToast([err_message]);

}

function validateForm() {

    event.preventDefault();

    var x = document.forms["myForm"]["email"].value;
    var y = document.forms["myForm"]["password"].value;
    var error = document.getElementsByClassName('error-msg');
    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;


    // REQUIRED VALIDATION


    if (x == "" && y == "") {
        error[0].innerHTML = "Required!";
        error[0].style.display = "block";
        error[1].style.display = "block";
        login_error_toaster(1);
        return false;
    }
    else if (x == "") {
        error[0].innerHTML = "Required!";
        error[0].style.display = "block";
        error[1].style.display = "none";
        login_error_toaster(2);
        return false;
    }
    else if (y == "") {
        error[0].style.display = "none";
        error[1].style.display = "block";
        login_error_toaster(3);
        return false;
    }
    else {
        error[0].style.display = "none";
        error[1].style.display = "none";
    }

    // EMAIL FORMAT VALIDATION

    if (x != "" && x.match(mailformat) && y != "") {
        error[0].style.display = "none";
        // return true;
    }
    else {
        if (x != "" && x.match(mailformat) && y == "") {
            error[0].style.display = "none";
            error[1].style.display = "block";
            login_error_toaster(4);
            return false;
        }
        else {
            error[0].innerHTML = "Invalid Email";
            error[0].style.display = "block";
            login_error_toaster(5);
            return false;
        }
    }

    document.getElementById("loginForm").submit();
}

function handleAJAXError(err) {
    var r = JSON.parse(err.responseText).errors;

    try{
        var keys = Object.keys(r);

        var errors = [];
        for (let index = 0; index < keys.length; index++) {
            errors.push(r[keys[index]]);
        }

        makeToast(errors);
    }
    catch (err){
        console.log(err);
    }
}
