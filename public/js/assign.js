const { assign } = require("lodash");

function assignDisplay(x)
{
  
  var row=document.getElementById('user-row-'+x);
  console.log('user-row-'+x);
  
  if (row.style.display === "block") {
    row.style.display = "none";
  } else {
    
    row.style.display = "block";
    
  }
}

function year_inc(x){
  var year= document.getElementById('assign_year');  
  x=x+1;
  $assign_year=x;
  year.innerText=x;
    
}

function year_dec(x){
  var year= document.getElementById('assign_year');  
  x=x-1;
  $assign_year=x;
  year.innerText=x;
}