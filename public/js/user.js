////====USER-LIST====////

function fetchUserList_AJAX() {
    $.ajax({
        type: "post",
        url: "/API/fetchUserList",
        data: {
            _token: $('#csrf-token')[0].content,
        },
        cache: false,
        success: function (response) {
            if (response["resultStatus"]["isSuccess"]) {
                renderHTML(response);
            } else
                handleAJAXResponse(response);
        },
        error: function (err) {
            handleAJAXError(err);
        }
    });
}
var staffList, item;
function renderHTML(response) {
    var auth = document.getElementById('user-authority').value;
    console.log(auth);
    var staffs = document.getElementsByClassName('table-body');
    response["resultData"]["user"].forEach((row) => {


        var pos;
        switch (row.position) {
            case 0:
                pos = 'PM';
                break;
            case 1:
                pos = 'PL';
                break;
            case 2:
                pos = 'SE';
                break;
            case 3:
                pos = 'PG';
                break;
            default:
                pos = 'SE';
        }
        // USER_LOCATION
        var loc;
        switch (row.location) {
            case 0:
                loc = '宮崎';
                break;
            case 1:
                loc = '東京';
                break;
            case 2:
                loc = '福岡';
                break;

            default:
                loc = '宮崎';
                break;
        }
        // DATE
        let today = new Date();
        let date = new Date(row.admissionDay);
        var unit = '年';
        var time_diff = Math.floor((today.getTime() - date.getTime()) / 1000 / 3600 / 24 / 365);
        if (time_diff == 0) {
            time_diff = Math.floor((today.getTime() - date.getTime()) / 1000 / 3600 / 24 / 30);
            unit = '月';

        }

        //GENDER
        var gender;
        switch (row.gender) {
            case 0:
                gender = './img/pro_icon.png';
                break;
            case 1:
                gender = './img/pro_icon3.png';
                break;
        }
        // console.log(gender);

        var unitPrice = numberWithCommas(row.unitPrice) + " 円";
        if (auth != 0) {
            unitPrice = '';
        }

        rowHtml = `<div class="card _user" id="user-row-${row.userID}">` +
            `<div class="card-header">` +
            `<div class="display list-unstyled">` +
            `<li>${row.userID}</li>` +
            `<li><img src="${gender}" class="smallpic">
                <div class="user-name">${row.username}</div></li>` +
            `<li class="user-location">${loc}</li>` +
            `<li><div class="pos pos-${pos}">${pos}</div></li>` +
            `<li>${time_diff}${unit}</li>` +
            `<li>${unitPrice}</li>` +
            `<li><div class="edit"><span style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span>編集</div></li>` +
            `</div></div></div>`;

        staffs[0].innerHTML += rowHtml;
        staffList = document.querySelectorAll('.staffs .card');
        item = document.querySelectorAll('.pos');
    });

}
document.addEventListener("DOMContentLoaded", () => { fetchUserList_AJAX() });

pos = document.querySelector('.userlist-nav');
console.log(staffList);
pos.addEventListener("click", filterPos);

function filterPos(e) {
    e.preventDefault();
    console.log(e.target.innerText);
    switch (e.target.innerText) {
        case "全て":
            {
                for (let i = 0; i < item.length; i++) {
                    showCard(staffList[i])
                }
                break;
            }
        case "PM":
            {
                for (let i = 0; i < item.length; i++) {
                    if (item[i].innerText == "PM") {
                        showCard(staffList[i])
                    }
                    else {
                        hideCard(staffList[i])
                    }
                }
                break;
            }
        case "SE":
            {
                for (let i = 0; i < item.length; i++) {
                    if (item[i].innerText == "SE") {
                        showCard(staffList[i])
                    }
                    else {
                        hideCard(staffList[i])
                    }
                }
                break;
            }
        case "PG":
            {
                for (let i = 0; i < item.length; i++) {
                    if (item[i].innerText == "PG") {
                        showCard(staffList[i])
                    }
                    else {
                        hideCard(staffList[i])
                    }
                }
                break;
            }
        case "PL":
            {
                for (let i = 0; i < item.length; i++) {
                    if (item[i].innerText == "PL") {
                        showCard(staffList[i])
                        console.log(staffList[i]);
                    }
                    else {
                        hideCard(staffList[i])
                    }
                }
                break;
            }
    }
}
