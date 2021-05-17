function makeToast(message) {
  // document.body.innerHTML += style + toast_div;

  var x = document.getElementById("snackbar");

  x.innerHTML = "";
  for (let index = 0; index < message.length; index++) {
    x.innerHTML += "<div>" + message[index] + "</div>";
  }

  x.className = "show";
  setTimeout(function () {
    x.className = "hide";
  }, message.length * 2000);

}




