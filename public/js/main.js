

function validateForm() {
  var x_type = document.forms["myForm"]["email"].type;
  var x = document.forms["myForm"]["email"].value;
  var y= document.forms["myForm"]["password"].value;
  var error=document.getElementsByClassName('error-msg');
  var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	

	// REQUIRED VALIDATION


	if (x == ""&&y=="") {
		error[0].innerHTML = "Required!";
	    error[0].style.display="block";
	    error[1].style.display="block";
	    return false;
	  }
	 else if (x == "") {
	  	error[0].innerHTML = "Required!";
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

////========SIDEBAR MENU==========////

var text=document.getElementsByClassName('label-text');
var menu=document.getElementById('header_top');
function sidebar_expand(sidebar){
	for(var i=0;i<5;i++)
	{
		text[i].style.display="inline-block";
	}
	sidebar.style.transition="none";
	sidebar.style.width="210px";
	menu.classList.add('fade-left');
	
}
function normalsideBar(sidebar){
	
	for(var i=0;i<5;i++)
	{
		text[i].style.display="none";
	}
	sidebar.style.width="60px";
	sidebar.style.transition="1s ease";
	menu.classList.remove('fade-left');
}