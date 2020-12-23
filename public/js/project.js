// const { data } = require("jquery");

var coll1 = document.getElementById("row1head");
var content1 = document.getElementById("row1");
var content2 = document.getElementById("row2");
PROJECT_CARDS = [];


function display(x) {

    var row = document.getElementById('row' + x);
    console.log(row.style.display);

    if (row.style.display === "block") {
        row.style.display = "none";
    } else {

        row.style.display = "block";

    }
}

function fetchProjectList_AJAX() {
    $.ajax({
        type: "get",
        url: "/API/fetchProjectList",
        data: {
            _token: $('#csrf-token')[0].content,
        },
        cache: false,
        success: function (response) {

            if (response["resultStatus"]["isSuccess"]) {

                projectRender();

                function projectRender() {
                    setTimeout(function () {
                        if (USER_LIST.length > 0 && CLIENT_LIST.length > 0) {
                            renderProjectHTML(response);
                        }
                        else projectRender();
                    }, 10)
                }

            } else
                handleAJAXResponse(response);
        },
        error: function (err) {
            handleAJAXError(err);
        }
    });
}

function getOrderStatusHTML(data) {
    switch (data) {
        case 0: return "<li><div class='order-tag _red'>A</div></li>";
        case 1: return "<li><div class='order-tag _orange'>B</div></li>";
        case 2: return "<li><div class='order-tag _orange'>C</div></li>";
        case 3: return "<li><div class='order-tag _gray'>Z</div></li>";
        case 4: return "<li><div class='order-tag _green'>○</div></li>";
        default: return "<li></li>";
    }
}

function getBusinessSituationHTML(data) {
    switch (data) {
        case 0: return "<li><div class='business-tag _green'>● 見積前</div></li>";
        case 1: return "<li><div class='business-tag _green'>● 見積中</div></li>";
        case 2: return "<li><div class='business-tag _green'>● 見積済</div></li>";
        case 3: return "<li><div class='business-tag _green'>● 受注</div></li>";
        case 4: return "<li><div class='business-tag _green'>● 検収中</div></li>";
        case 5: return "<li><div class='business-tag _green'>● 完了</div></li>";
        default: return "<li></li>";
    }
}

function getDevelopmentStageHTML(data) {
    switch (data) {
        case 0: return "<li><div class='development-tag _blue'>受注前着手</div></li>";
        case 1: return "<li><div class='development-tag _blue'>要件定義</div></li>";
        case 2: return "<li><div class='development-tag _blue'>設計</div></li>";
        case 3: return "<li><div class='development-tag _blue'>実装</div></li>";
        case 4: return "<li><div class='development-tag _blue'>テスト</div></li>";
        case 5: return "<li><div class='development-tag _blue'>開発完了</div></li>";
        default: return "<li></li>";
    }
}

function renderProjectHTML(response) {

    var projects = document.getElementById('accordian');

    response["resultData"]["project"].forEach((row) => {

        Object.keys(row).forEach(e => (row[e] == null) ? row[e] = "" : true);

        var profit = (row.salesTotal - row.budget) * 100 / row.salesTotal;
        projectHtml =
            `<div class="card _project" id="project-row-">` +
            `<div class="card-header" id="row1head" onclick="display(${row.projectID})">` +
            `<div class="display list-unstyled">` +
            `<li>${row.projectName}</li>` +
            `<li>${convertClient_IDToName(row.clientID)}</li>` +
            `<li><img src="img/pro_icon.png" class="smallpic">` +
            `<div class="user-name">${convertUser_IDToName(row.projectLeaderID)}</div>` +
            `</li>` +
            getOrderStatusHTML(row.orderStatus) +
            getBusinessSituationHTML(row.businessSituation) +
            getDevelopmentStageHTML(row.developmentStage) +
            `<li>${row.orderMonth}</li>` +
            `<li>${row.inspectionMonth}</li>` +
            `<li class="right-align">${numberWithCommas(row.salesTotal) + " 円"}</li>` +
            `<li class="right-align">${numberWithCommas(row.budget) + " 円"}</li>` +
            `<li>${profit}%</li>` +
            `<li>` +
            `<div class="edit" onclick="projectEditModalHandler(${row.projectID})">` +
            `<span style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span>編集` +
            `</div>` +
            `</li>` +
            `</div>` +
            `</div>` +

            `<div class="collapse show" id="row${row.projectID}">` +
            renderEmptyAssignAccordion(row.projectID) +
            `</div>` +
            `</div>`;
        projects.innerHTML += projectHtml;
    });

    PROJECT_CARDS = document.querySelectorAll('._project.card');
    console.log(PROJECT_CARDS);

}

function renderEmptyAssignAccordion(projectID) {

    accordionHTML =

        `<div class="card-body row _accordion">` +

        `<div class="table-left">` +
        `<table>` +
        `<tr>
                        <td>予算</td>
                        <td>71,4000　円</td>
                    </tr>`+
        `<tr>
                        <td>原価</td>
                        <td>10,0000　円</td>
                    </tr>`+
        `<tr>
                        <td>工数</td>
                        <td>10,0000　円</td>
                    </tr>`+
        `<tr>
                        <td>粗利</td>
                        <td>1000　円</td>
                    </tr>`+
        `<tr>
                        <td>率</td>
                        <td>75.4　%</td>
                    </tr>`+
        `<tr>
                        <td>期間</td>
                        <td>2001-2004</td>
                    </tr>`+
        `</table>` +
        `</div>` +
        ` <div class="project-rhs">` +
        `<div class="add-minus-holder editMode">
                    <button class="btn round-btn primary _plus"><span
                            class="fa fa-plus"></span></button>
                    <button class="btn round-btn danger _minus"><span
                            class="fa fa-minus"></span></button>
                </div>`+

        `<div class="table-right row">` +
        `<table class="table-fix">` +
        `<tr>
                            <th class="mishti-orange">メンバー</th>
                            <th class="mishti-orange">工数合計</th>

                        </tr>`+
        `<tr class="row-total">
                            <td>3</td>
                            <td>54.0</td>
                        </tr>`+
        `<tr>
                            <td><img src="img/pro_icon.png">社員</td>
                            <td>18.0</td>

                        </tr>`+
        `<tr>
                            <td><img src="img/pro_icon.png">社員</td>
                            <td>18.0</td>
                        </tr>`+
        `<tr>
                            <td><img src="img/pro_icon.png">社員</td>
                            <td>18.0</td>
                        </tr>`+
        `</table>` +
        `<div class="table-des-container">` +
        `<table class="table-des">` +
        `<tr>` +
        `<th>2020/01</th>
                                <th>2020/02</th>
                                <th>2020/03</th>
                                <th>2020/04</th>
                                <th>2020/05</th>
                                <th>2020/06</th>
                                <th>2020/07</th>
                                <th>2020/08</th>
                                <th>2020/09</th>
                                <th>2020/10</th>
                                <th>2020/11</th>
                                <th style="background-color:#ffbf0b;color:black">2020/12</th>
                                <th>2021/01</th>
                                <th>2022/02</th>
                                <th>2021/03</th>
                                <th>2022/04</th>
                                <th>2021/05</th>
                                <th>2022/06</th>`+

        `</tr>` +
        `<tr class="row-total">` +
        `<td>3.00</td>
                                <td>3.00</td>
                                <td>3.00</td>
                                <td>3.00</td>
                                <td>3.0</td>
                                <td>3.0</td>
                                <td>3.0</td>
                                <td>3.0</td>
                                <td>3.0</td>
                                <td>3.0</td>
                                <td>3.0</td>
                                <td>3.0</td>
                                <td>3.0</td>
                                <td>3.0</td>
                                <td>3.0</td>
                                <td>3.0</td>
                                <td>3.0</td>
                                <td>3.0</td>`+

        `</tr>` +
        `<tr class="editMode-input">
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>

                            </tr>`+
        `<tr class="editMode-input">
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>

                            </tr>`+
        `<tr class="editMode-input">
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>

                            </tr>`+
                            

        `</table>` +
        `</div>` +
        `</div>` +
        `</div>` +
        `<div class="action">` +
        `<ul class="list-unstyled">
                    <li class="list show"><button class="btn round-btn pencil-btn" onclick="editModeOn(${projectID})"><span style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span></button></li>
                    <div class="editMode">
                        <li class="list"><button class="btn round-btn danger"><span
                        class="fa fa-trash"></span></button></li>
                        <li class="list"><button class="btn round-btn success midori"><span
                                    class="fa fa-undo"></span></button></li>
                        <li class="list"><button class="btn round-btn primary"><span
                                    class="fa fa-save" onclick="editModeOff(${projectID})"></span></button></li>
                    </div>
                </ul>`+
        `</div>` +
        `</div>`;

    return accordionHTML;
}

document.addEventListener("DOMContentLoaded", () => { fetchProjectList_AJAX() });


pos = $('.userlist-nav a li');

pos.off("click");
pos.on("click", function () {
    event.preventDefault();

    clickedItem = $($(this)[0]).html();
    console.log(clickedItem);


    switch (clickedItem) {
        case "全て":
            for (let i = 0; i < PROJECT_CARDS.length; i++) {
                showCard(PROJECT_CARDS[i])
            }
            return;
        case "A": case "B": case "C": case "○": case "Z":
            showHideProjectHandler("order-tag", clickedItem);
            return;
        case "見積": case "受注": case "検収": case "完了":
            showHideProjectHandler("business-tag", clickedItem);
            return;
        case "要件": case "設計": case "実装": case "テスト": case "開発完了":
            showHideProjectHandler("development-tag", clickedItem);
            return;
    }


    function showHideProjectHandler(domType, itemName) {
        for (let i = 0; i < PROJECT_CARDS.length; i++) {

            text = $(PROJECT_CARDS[i]).find("." + domType).html();
            console.log(text);

            if (text == null) {
                hideCard(PROJECT_CARDS[i])
                continue;
            }

            if (text.includes(itemName)) {
                showCard(PROJECT_CARDS[i])
            }
            else {
                hideCard(PROJECT_CARDS[i])
            }

        }
    }

});


function filterProject(e) {
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

function editModeOn(x){
    

    var buttons = document.getElementsByClassName('editMode');
    var rightTable=document.querySelectorAll('.table-des');
    // var dataCells=dataTable[x-1].querySelectorAll('td');
    var dataTable=rightTable[x-1].querySelectorAll('.editMode-input ');
    // console.log(dataTable.length);
    for(let i=0;i<buttons.length;i++)
    {
        buttons[i].style.display="block";
        document.getElementsByClassName('pencil-btn')[x-1].style.display="none";
    }
    
    for(i=0;i<dataTable.length;i++){
        var dataCells=dataTable[i].querySelectorAll('td');
        console.log(dataCells);
        for(let j=0;j<dataCells.length;j++){
            dataCells[j].innerHTML="<input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"1.00\">";
        }
    }
    
      
}

function editModeOff(x){
    var details;
    details = $('.data-cell').map(function() {
        return {
          val: $(this).val(),
        };
      }).get();
      console.log(details[0].val);
    var buttons = document.getElementsByClassName('editMode');
    var rightTable=document.querySelectorAll('.table-des');
    // var dataCells=dataTable[x-1].querySelectorAll('td');
    var dataTable=rightTable[x-1].querySelectorAll('.editMode-input ');
    // console.log(buttons);
    for(let i=0;i<buttons.length;i++)
    {
        buttons[i].style.display="none";
        document.getElementsByClassName('pencil-btn')[x-1].style.display="block";
    }
    let k=0;
    for(i=0;i<dataTable.length;i++){
        var dataCells=dataTable[i].querySelectorAll('td');
        // console.log(dataCells);
        for(let j=0;j<dataCells.length;j++){
            dataCells[j].innerHTML=details[k].val;
            k++            
        }
    }
    k=0;
   
    
}