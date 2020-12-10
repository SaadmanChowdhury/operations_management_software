var coll1 = document.getElementById("row1head");
var content1 = document.getElementById("row1");
var content2 = document.getElementById("row2");


function display(x)
{
  
  var row=document.getElementById('row'+x);
  console.log(row.style.display);
  
  if (row.style.display === "block") {
    row.style.display = "none";
  } else {
    
    row.style.display = "block";
    
  }
}
