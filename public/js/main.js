

function validateForm() {
  var x_type = document.forms["myForm"]["email"].type;
  var x = document.forms["myForm"]["email"].value;
  var y= document.forms["myForm"]["password"].value;
  var error=document.getElementsByClassName('error-msg');
  var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	

	// REQUIRED VALIDATION


	if (x == ""&&y=="") {
		error[0].innerHTML = "Required";
	    error[0].style.display="block";
	    error[1].style.display="block";
	    return false;
	  }
	 else if (x == "") {
	  	error[0].innerHTML = "Required";
	    error[0].style.display="block";
	    error[1].style.display="none";
	    return false;
	 }
	  else if (y=="") {
	   	error[0].style.display="none";
	    error[1].style.display="block";
	    return false;
	  }
	  else{
	  	error[0].style.display="none";
	  	error[1].style.display="none";
	  }

	  // EMAIL FORMAT VALIDATION

	  if(x!="" && x.match(mailformat) && y!="")
		{
			error[0].style.display="none";
			return true;
		}
		if(x!="" && x.match(mailformat) && y=="")
		{
			error[0].style.display="none";
			error[1].style.display="block";
			return false;
		}
		else
		{
			error[0].innerHTML = "Invalid Email";
			error[0].style.display="block";
			return false;
		}
}