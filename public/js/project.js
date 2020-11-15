var coll1 = document.getElementById("row1head");
var content1 = document.getElementById("row1");
var content2 = document.getElementById("row2");
var content3 = document.getElementById("row3");
var plusbtn= document.getElementsByClassName("add");
var view=window.matchMedia("(min-width: 1400px)");
var h=50;
function myFunction(view){
  if(view.matches)
  {
    var pos=document.getElementsByClassName('table-right')[0].getBoundingClientRect();
    plusbtn[1].style.marginTop=`${pos.bottom-pos.top+95}px`;
  }
  else{
   var pos=document.getElementsByClassName('table-right')[0].getBoundingClientRect();
    plusbtn[1].style.marginTop=`${pos.bottom-pos.top}px`;
  }
}
myFunction(view);
view.addEventListener("fullscreen",myFunction);
coll1.addEventListener("click", function() {


    if (content1.style.display === "block") {
      content1.style.display = "none";
    } else {
      content2.style.display = "none";
      content1.style.display = "block";
      content3.style.display = "none";
    }
    
    var pos=document.getElementsByClassName('table-right')[0].getBoundingClientRect();
    var height=document.getElementsByTagName('tbody')[1].offsetHeight;
    console.log(h);
    // var pos2= plusbtn[0].getBoundingClientRect();
    // console.log(pos.bottom-pos.top);
    // console.log(plusbtn[0]);
    plusbtn[0].style.marginTop=`${pos.bottom-pos.top-h}px`;
    //console.log(pos2.top);
    console.log(plusbtn[0].style.marginTop);



});


var coll2 = document.getElementById("row2head");				
coll2.addEventListener("click", function() {



    if (content2.style.display === "block") {
      content2.style.display = "none";
    } else {
      content2.style.display = "block";
      content1.style.display = "none";
      content3.style.display = "none";
    }
    myFunction(view);


});


var coll3 = document.getElementById("row3head");				
coll3.addEventListener("click", function() {



    if (content3.style.display === "block") {
      content3.style.display = "none";
    } else {
      content2.style.display = "none";
      content1.style.display = "none";
      content3.style.display = "block";
    }

    var pos=document.getElementsByClassName('table-right')[2].getBoundingClientRect();
    plusbtn[2].style.marginTop=`${pos.bottom-pos.top-50}px`;

});
