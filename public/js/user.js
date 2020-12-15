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
                    showCard(staffList[i])
                }
                break;
            }
        case "PM":
            {
                for (i = 0; i < item.length; i++) {
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
                for (i = 0; i < item.length; i++) {
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
                for (i = 0; i < item.length; i++) {
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
                for (i = 0; i < item.length; i++) {
                    if (item[i].innerText == "PL") {
                        showCard(staffList[i])
                    }
                    else {
                        hideCard(staffList[i])
                    }
                }
                break;
            }
    }
}
function numberWithCommas(x) {
    var z = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    console.log("hey");
    document.getElementsByClassName('salary').innerText = z;
}

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

function renderHTML(response) {

    var staffs=document.getElementsByClassName('table-body');
    response["resultData"]["user"].forEach((row) => {
        var card=document.createElement('div');
        card.classList.add('card');
        var cardHead=document.createElement('div');
        cardHead.classList.add('card-header');
        card.appendChild(cardHead);
        console.log(card);
        var display=document.createElement('div');
        display.classList.add('display');
        display.classList.add('list-unstyled');
        cardHead.appendChild(display);
        console.log(card);
        console.log(row);
        // var li=[];
        // for(i=0;i<6;i++)
        // {
        //     li[i]=document.createElement('li');
        // }
        rowHtml=`<li>${row.userID}</li>`+
                `<li><img src="{{asset("img/".$pro_icon.".png")}}" class="smallpic">
                <div class="user-name">${row.username}</div></li>`+
                `<li class="user-location">${row.location}</li>`+
                `<li>${row.position}</li>`+
                `<li>${row.userID}</li>`+
                `<li>${row.unitPrice}</li>`;
        display.innerHTML+=rowHtml;
        // switch(row.position)
        // {
        //     case 0:
        //         li[3].textContent='PM';
        //         break;
        //     case 1:
        //         li[3].textContent='PL';
        //         break;
        //     case 2:
        //         li[3].textContent='SE';
        //         break;
        //     case 3:
        //         li[3].textContent='PG';
        //         break;
        //     default:
        //         li[3].textContent='SE';
        // }
        // li[0].textContent=row.userID;
        // li[1].textContent=row.username;
        // li[2].textContent=row.location;
        
        // li[4].textContent=row.userID;
        // li[5].textContent=row.unitPrice;
        
        var editHtml = 
        `<li><div class="edit"><span style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span>編集</div></li>`; 
        
        // for(i=0;i<6;i++)
        // {
        //     display.appendChild(li[i]);
        // }
        display.innerHTML+=editHtml;
        staffs[0].appendChild(card);
    });
    
    

}