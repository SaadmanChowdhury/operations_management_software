// var toast_div = `<div id="snackbar">Some text some message..</div>`;

// var style = `
// <style>
// #snackbar {
//   visibility: hidden;
//   min-width: 250px;
//   margin-left: -125px;
//   background-color: #0b1841;
//   color: #fff;
//   text-align: left;
//   border-radius: 10px;
//   padding: 16px;
//   position: fixed;
//   z-index: 1;
//   right: 1rem;
//   top: 1rem;
//   font-size: 17px;
// }

// #snackbar.show {
//   visibility: visible;

// }

// @-webkit-keyframes fadein {
//   from {bottom: 0; opacity: 0;} 
//   to {bottom: 30px; opacity: 1;}
// }

// @keyframes fadein {
//   from {bottom: 0; opacity: 0;}
//   to {bottom: 30px; opacity: 1;}
// }

// @-webkit-keyframes fadeout {
//   from {bottom: 30px; opacity: 1;} 
//   to {bottom: 0; opacity: 0;}
// }

// @keyframes fadeout {
//   from {bottom: 30px; opacity: 1;}
//   to {bottom: 0; opacity: 0;}
// }

// </style>
// `;




function makeToast(message) {
  // document.body.innerHTML += style + toast_div;

  var x = document.getElementById("snackbar");

  x.innerHTML = "";
  for (let index = 0; index < message.length; index++) {

    if (index == 0) {
      x.innerHTML += ` <div  style="text-align: right"  > <div style="float:left;" >` + message[index] + '</div>   <div   style="display:inline-block; padding-left:5px; " onClick="hideSnackBar(this)" > X </div> </div>';

    }

    else {

      x.innerHTML += "<div>" + message[index] + "</div>";


    }
  }

  x.className = "show";
  setTimeout(function () {
    x.className = "hide";
  }, message.length * 8000 > 60000 ? 60000 : message.length * 8000);




}


function hideSnackBar(ele) {
  ele.parentNode.parentNode.className = "hide";
}




