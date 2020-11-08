////====USER-LIST====////


var pos = document.querySelector('.userlist-nav');
var staffList = document.querySelectorAll('.staffs .card');
var item = document.querySelectorAll('.pos');

pos.addEventListener("click", filterPos);

function filterPos(e) {
    e.preventDefault();
    console.log(e.target.innerText);
    switch (e.target.innerText) {
        case "全て":
        {
            for (i = 0; i < item.length; i++) {
                staffList[i].style.display = "flex";
            }
            break;
        }
        case "PM":
        {
            for (i = 0; i < item.length; i++) {
                if (item[i].innerText == "PM") {
                    staffList[i].style.display = "flex";
                }
                else {
                    staffList[i].style.display = "none";
                }
            }
            break;
        }
        case "SE":
        {
            for (i = 0; i < item.length; i++) {
                if (item[i].innerText == "SE") {
                    staffList[i].style.display = "flex";
                }
                else {
                    staffList[i].style.display = "none";
                }
            }
            break;
        }
        case "PG":
        {
            for (i = 0; i < item.length; i++) {
                if (item[i].innerText == "PG") {
                    staffList[i].style.display = "flex";
                }
                else {
                    staffList[i].style.display = "none";
                }
            }
            break;
        }
        case "PL":
        {
            for (i = 0; i < item.length; i++) {
                if (item[i].innerText == "PL") {
                    staffList[i].style.display = "flex";
                }
                else {
                    staffList[i].style.display = "none";
                }
            }
            break;
        }
    }
}
function numberWithCommas(x) {
    var z= x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
    console.log("hey");
    document.getElementsByClassName('salary').innerText=z;
}