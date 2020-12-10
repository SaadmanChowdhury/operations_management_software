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