var coll1 = document.getElementById("row1head");
var content1 = document.getElementById("row1");
var content2 = document.getElementById("row2");


function display(x)
{
  
  var row=document.getElementById('row'+x);
  console.log(row.style.display);
  // row.style.display="block";
  if (row.style.display === "block") {
    row.style.display = "none";
  } else {
    
    row.style.display = "block";
    
  }
}
// coll1.addEventListener("click", function() {


//     if (content1.style.display === "block") {
//       content1.style.display = "none";
//     } else {
//       content2.style.display = "none";
//       content1.style.display = "block";
      
//     }
    
    
// });


// var coll2 = document.getElementById("row2head");				
// coll2.addEventListener("click", function() {



//     if (content2.style.display === "block") {
//       content2.style.display = "none";
//     } else {
//       content2.style.display = "block";
//       content1.style.display = "none";
//     }
    
// });

