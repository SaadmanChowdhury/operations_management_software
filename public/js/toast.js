function makeToast(message) {
  // document.body.innerHTML += style + toast_div;

  var x = document.getElementById("snackbar");

  x.innerHTML = "";
  for (let index = 0; index < message.length; index++) {
    x.innerHTML += "<div>● " + message[index] + "</div>";
  }

  x.className = "snackbar-show";
  setTimeout(function () {
    x.className = "snackbar-hide";
  }, message.length * 8000 > 60000 ? 60000 : message.length * 8000);


  document.getElementById("snackbar").addEventListener("click", function () {
    this.className = "snackbar-hide";
  });
}
