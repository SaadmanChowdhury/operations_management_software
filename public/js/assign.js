// const { assign } = require("lodash");

function assignDisplay(x) {

  var row = document.getElementById('user-row-' + x);
  console.log('user-row-' + x);

  if (row.style.display === "block") {
    row.style.display = "none";
  } else {

    row.style.display = "block";

  }
}

function year_inc() {
  var year = document.getElementById('assign_year');
  year.innerHTML = parseInt(year.innerHTML) + 1;
  onYearChanged(parseInt(year.innerText));
}

function year_dec() {
  var year = document.getElementById('assign_year');
  year.innerHTML = parseInt(year.innerHTML) - 1;
  onYearChanged(parseInt(year.innerText));
}

